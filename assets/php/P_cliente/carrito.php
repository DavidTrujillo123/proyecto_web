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

$usuario = $_SESSION['usuario']; //asigna la sesión al usuario
//busca la cedula, sea con el nombre de usuario o email en la tabla usuario
$sql1 = "SELECT id_usuario FROM usuario WHERE usuario LIKE '$usuario' or email LIKE '$usuario'";
$cliente = $db->Read($sql1);
$id_usuario = $cliente[0]['id_usuario'];//id usuario dependiendo de la sesion

$sql_carrito = "SELECT id_carrito FROM carrito WHERE carrito.id_usuario=$id_usuario";
$cart = $db->Read($sql_carrito);
$id_carrito = $cart[0]['id_carrito'];//carrito del usuario


if (isset($_GET['agregar'])) {
    $agregar = $_GET['agregar'];//codigo_producto
    
    $sql2 = "SELECT * FROM `carrito_item` 
            WHERE carrito_item.id_carrito=$id_carrito 
            AND carrito_item.codigo_producto='$agregar'";

    $res = $db->OperSql($sql2);
    $num_productos = $res->num_rows;
    
    if ($num_productos == 0) { 
        $sql = "INSERT INTO 
                carrito_item(id_carrito, codigo_producto, 
                cantidad_cliente, subtotal)
                VALUES ('$id_carrito','$agregar','1',
                (SELECT precio FROM producto 
                WHERE codigo_producto LIKE '$agregar'))";
        $prod_carrito = $db->OperSql($sql);
    } else {
        $fila = mysqli_fetch_array($res);
        $cantidad = $fila['cantidad_cliente'] + 1;

        $sql = "UPDATE carrito_item 
                SET carrito_item.cantidad_cliente=$cantidad , 
                carrito_item.subtotal=(SELECT precio
                    FROM producto 
                    WHERE codigo_producto='$agregar')*$cantidad 
                    WHERE carrito_item.codigo_producto LIKE '$agregar' 
                    AND carrito_item.id_carrito=$id_carrito";
        $prod_carrito = $db->OperSql($sql);
    }

    echo (" <script> 
                window.location.href = '../../../pagina_cliente.php#product';
            </script> ");
}
if (isset($_POST['id1'])) {

    $id1 = $_POST['id1'];

    $sql1 = "SELECT cantidad 
            FROM producto 
            WHERE codigo_producto= '$id1' ";

    $cantidad = $db->Read($sql1);
    $cantidadUnit = $cantidad[0]['cantidad'];

    //comprueba si la cantidad es igual o menor a la cantidad de stock
    if ($_POST['cantidad'] <= $cantidadUnit) {
        $cantidad = $_POST['cantidad'];

        $sql = "UPDATE carrito_item 
                SET carrito_item.cantidad_cliente=$cantidad , 
                carrito_item.subtotal=(SELECT precio 
                    FROM producto 
                    WHERE codigo_producto='$id1')*$cantidad 
                    WHERE carrito_item.codigo_producto='$id1' 
                    AND carrito_item.id_carrito=$id_carrito";
        $prod_carrito = $db->OperSql($sql);
    } else {
        echo ("<script> 
                    alert('Cantidad Insuficiente en stock !');
                </script> ");
    }
}
//Elimina produtos del carrito
if (isset($_GET['eliminar'])) {
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

</head>

<body>
    <?php
    include('../../../footer_nav_cliente/nav_clientes.php');

    ?>
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>subtotal</th>
            <th>Eliminar</th>
        </tr>
        <?php
        $sql = "SELECT * FROM `producto`";
        $productos = $db->OperSql($sql);

        $sql2 = "SELECT * FROM producto,carrito_item,carrito 
                WHERE carrito_item.id_carrito=carrito.id_carrito 
                AND producto.codigo_producto=carrito_item.codigo_producto 
                AND carrito.id_usuario=$id_usuario ";
        $Total = 0;
        $carrito = $db->OperSql($sql2);

        foreach ($carrito as $row) {
            $Total = $Total + $row['subtotal'];
            echo '
              <form action="carrito.php" method="post" >
                <tr>
                    <td><img heigth="30px" src="data:image/jpg;base64,' . base64_encode($row['img']) . '"/></td>
                    <td>' . $row['nombre_producto'] . '</td>
                    <td>' . $row['precio'] . '</td>
                    <td> <input value="' . $row['cantidad_cliente'] . '" type="number" name="cantidad">
                    <input type="hidden"  value="' . $row['codigo_producto'] . '" name="id1">
                    
                    </td>
                    <td>' . $row['subtotal'] . '</td>
                    <td><input type="submit" value="Actualizar Cantidad" ></td>
                    <td><a href="#" onclick="eliminar(' . $row['id_carrito_item'] . ')">Eliminar</td>



                </tr>
                </form>

                
                
                
                ';
        }



        ?>
    </table>
    <?php echo $Total; ?>
    <?php
    include("../../../footer_nav_cliente/footer.php");
    ?>


</body>
<script src="../../js/paginaCliente.js" defer></script>

<script>
    function eliminar(id) {
        if (confirm("Deseas Eliminar del Carrito ")) {
            window.location = "carrito.php?eliminar=" + id;
        }


    }
</script>
   <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>