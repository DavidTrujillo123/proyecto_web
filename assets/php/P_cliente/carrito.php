<?php
session_start();
if (!isset($_SESSION['usuario'])) { //Si no existe una sesión activa
    echo '
      <script>
        alert("Inicia sesión antes de ingresar");
        window.location = "./login_registro.php";
      </script>
      ';
    session_destroy();
    die();
}

include("../Conexion.php");
$db = new Conexion();
$sql = "SELECT * FROM `cliente`";
$res = $db->OperSql($sql);
$num_clientes = $res->num_rows;//numero de clientes
$Total=0;

$usuario = $_SESSION['usuario']; //asigna la sesión al usuario
$db = new Conexion();
//busca el id del usuario , sea con el nombre de usuario o email en la tabla usuario
$sql1 = "SELECT id_usuario FROM usuario WHERE usuario= '$usuario' or email='$usuario'";
$cliente = $db->Read($sql1);
$id_usuario = $cliente[0]['id_usuario'];
//busca el id del carrito 
$sql_carrito = "SELECT id_carrito FROM carrito WHERE carrito.id_usuario=$id_usuario";
$cart = $db->Read($sql_carrito);
$car1 = $db->OperSql($sql_carrito);//obtener las filas del carrito
$nrows = $car1->num_rows;
$nrows = $nrows-1;	//ultima fila del carrito
$id_carrito = $cart[$nrows]['id_carrito'];


if (isset($_GET['agregar'])) {//Comprueba si la variable existe al mandar el codigo del producto 
    $codigo = $_GET['agregar'];
    // $sql2 = "SELECT * FROM `producto` WHERE codigo='$codigo'";
    // $producto = $db->Read($sql2);

    $sql2 = "SELECT * FROM `carrito_item` 
            WHERE carrito_item.id_carrito=$id_carrito 
            AND carrito_item.codigo_producto='$codigo'";

    $res = $db->OperSql($sql2);
    $num_productos = $res->num_rows;

    if ($num_productos == 0) {//Comprueba que no este ingresado ni una vez para no repetir el producto  
        $sql = "INSERT INTO 
                carrito_item(id_carrito_item, id_carrito, 
                codigo_producto, cantidad_cliente, subtotal)
                VALUES (null,'$id_carrito','$codigo','1',
                (SELECT precio FROM producto WHERE 
                codigo_producto='$codigo')*1);";//Agrega una vez 
        $prod_carrito = $db->OperSql($sql);
    } else {
        $fila = mysqli_fetch_array($res);
        $cantidad = $fila['cantidad_cliente'] + 1;//Si el producto ya esta en carrito se agrega una vez mas 
        $sql = "UPDATE carrito_item 
                SET carrito_item.cantidad_cliente=$cantidad , 
                carrito_item.subtotal=(SELECT precio 
                FROM producto 
                WHERE codigo_producto='$codigo')*$cantidad 
                WHERE carrito_item.codigo_producto='$codigo' 
                AND carrito_item.id_carrito=$id_carrito";
        $prod_carrito = $db->OperSql($sql);
    }
    echo ("<script> 
    window.location.href = '../../../pagina_cliente.php#product';

    </script> ");
}
if (isset($_POST['id1'])) { //comprueba la cantidad que envia el cliente exista 
    $codigo = $_POST['id1'];
    $sql1 = "SELECT cantidad FROM producto WHERE codigo_producto= '$codigo' ";
    $cantidad = $db->Read($sql1);
    $cantidadUnit = $cantidad[0]['cantidad'];
    if ($_POST['cantidad'] <= $cantidadUnit) {//comprueba que la cantidad que envia el cliente sea menor que la cantidad que hay en stock
        //Actualiza la cantidad
        $sql = "UPDATE carrito_item 
                SET carrito_item.cantidad_cliente=$_POST[cantidad] , 
                carrito_item.subtotal=(SELECT precio 
                FROM producto 
                WHERE codigo_producto='$codigo')*$_POST[cantidad] 
                WHERE carrito_item.codigo_producto='$codigo' 
                AND carrito_item.id_carrito=$id_carrito";
        $prod_carrito = $db->OperSql($sql);
    } else {
        echo ("<script> 
                alert('Cantidad Insuficiente en stock !');
                window.location.href = './carrito.php';
            </script> ");
    }
}
if (isset($_GET['eliminar'])) {//comprueba la accion del eliminar la ejecuta 
    $sql = "DELETE FROM `carrito_item` 
            WHERE carrito_item.id_carrito_item=$_GET[eliminar]";
    $eliminar_prod = $db->OperSql($sql);
}



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="../../css/estilo_paginaCliente.css">
    <link rel="stylesheet" href="../../css/CssFooter.css">
    <link rel="shortcut icon" href="./assets/css/favicon.svg" type="image/svg+xml">

    <!-- 
  - custom css link
-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


    <!-- 
  - google font link
-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mr+De+Haviland&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="../../css/tabla.css" />
</head>

<body class="principal"  >
<?php
    include('../../../footer_nav_cliente/nav_clientes.php');

    ?>
    <div style="overflow-x: auto";>
    <div id="tabla">
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>subtotal</th>
            <th>Acciones</th>
        </tr>
        <?php
        $sql = "SELECT * FROM `producto`";
        $productos = $db->OperSql($sql);
        //Selecciona todos los datos que necesitamos para el carrito 

        $sql2 = "SELECT * FROM producto,carrito_item,carrito WHERE carrito_item.id_carrito=carrito.id_carrito 
        AND producto.codigo_producto=carrito_item.codigo_producto AND carrito.id_carrito=$id_carrito";
      
        $carrito = $db->OperSql($sql2);
        foreach ($carrito as $row) {
            $Total = $Total + $row['subtotal'];//calcula el total



            echo '
              <form action="carrito.php" method="post" >

                <tr>
                    <td><img heigth="30px" src="data:image/jpg;base64,' . base64_encode($row['img']) . '"/></td>
                    <td>' . $row['nombre_producto'] . '</td>
                    <td>' . $row['precio'] . '</td>
                    <td> <input value="' . $row['cantidad_cliente'] . '" type="number" name="cantidad">
                    <input id="ojo" type="hidden"  value="' . $row['codigo_producto'] . '" name="id1">
                    
                    </td>
                    <td>' . $row['subtotal'] . '</td>
                    <td><input type="submit" value="✏️" ><a href="#" onclick="eliminar(' . $row['id_carrito_item'] . ')">🗑️</td>
                    


                </tr>
                </form>

                      
                
                ';
        }
        ?>
       
        <tr>
            <td><h2>Total:</h2></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo $Total ?></td>
            <!-- <td><a href=""><button id="compra" onclick="comprar()">Comprar ahora         
            </button></a></td> -->
            <td><button onclick="comprar()">aaa</button></td>
        </tr>
      
    </table>

            
        
    </div>
   
    </div>

   <?php
    include("../../../footer_nav_cliente/footer.php");
    ?>


</body>


<script src="../../js/paginaCliente.js" defer></script>

<script>
    function eliminar(id) {//funcion propia para eliminar de javascript
        if (confirm("Deseas Eliminar del Carrito ")) {
            window.location = "carrito.php?eliminar=" + id;

        }


    }
</script>

<script>
    function comprar() {
        if (confirm("¿Estás seguro de que quiere realizar esta comprar?")) {
            window.location = ("./factura.php");  
            
        }
        

    }

</script>

   <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>