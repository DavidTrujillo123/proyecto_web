<?php include("./nav_footer_admin/session.php");
include("../assets/php/Conexion.php");

$db = new Conexion();
$sql = "SELECT cliente.cedula,nombre,apellido,fnacimiento,direccion,email,usuario,password,respuesta 
            FROM cliente, usuario 
            WHERE cliente.cedula = usuario.cedula";
$data = $db->Read($sql);

$admin = [];
$cliente = [];
$i = 0;
$j = 0;
foreach ($data as $row) {
    $name_user = $row['usuario'];
    if (preg_match("/^A\d+$/", "$name_user")) {
        $admin[$i] = $row;
        $i++;
    } else {
        $cliente[$j] = $row;
        $j++;
    }
}

$k = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script src="../assets/js/operacionesAdmin/admin_cliente.js"></script>
    <script src="../assets/js/operacionesAdmin/admin_producto.js"></script>
    <script src="../assets/js/operacionesAdmin/openPage.js"></script>
    <title>Document</title>
</head>

<body>
    <?php include("./nav_footer_admin/nav.php"); ?>
    <main id="principal">
        <h1>Usuarios</h1>
        <div id="tablas">
            <h3>Buscar:</h3>
            <input>
            <button>Buscar</button>
            <table id="tabla_admin">
                <h2>Administradores</h2>
                <tr>
                    <th>Cédula</th>
                    <th>Nombres</th>
                    <th>Fecha Nacimiento</th>
                    <th>Direccion</th>
                    <th>Correo Electrónico</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Respuesta</th>
                    <th>Acciones</th>
                </tr>
                <?php foreach ($admin as $row) { ?>
                    <tr>
                        <td id='cedula<?php $k ?>'><?php echo $row['cedula'] ?></td>
                        <td id='nombres<?php $k ?>'><?php echo $row['nombre'] . $row['apellido'] ?></td>
                        <td id='fnacimiento<?php $k ?>'><?php echo $row['fnacimiento'] ?></td>
                        <td id='direccion<?php $k ?>'><?php echo $row['direccion'] ?></td>
                        <td id='email<?php $k ?>'><?php echo $row['email'] ?></td>
                        <td id='usuario<?php $k ?>'><?php echo $row['usuario'] ?></td>
                        <td id='password<?php $k ?>'><?php echo $row['password'] ?></td>
                        <td id='password<?php $k ?>'><?php echo $row['respuesta'] ?></td>
                        <td><img onclick="eliminarCliente('<?php echo $row['cedula'] ?>')" alt='' src='../assets/images/icon-eliminar.png'>
                            <img onclick="Editar_usuario('<?php echo $row['cedula'] ?>')" alt='' src='../assets/images/icons-lapiz.gif'>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <table id="tabla_cliente">
                <h2>Clientes</h2>
                <tr>
                    <th>Cédula</th>
                    <th>Nombres</th>
                    <th>Fecha Nacimiento</th>
                    <th>Direccion</th>
                    <th>Correo Electrónico</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Respuesta</th>
                    <th>Acciones</th>
                </tr>
                <?php foreach ($cliente as $row) { ?>
                    <tr>
                        <td id='cedula<?php $k ?>'><?php echo $row['cedula'] ?></td>
                        <td id='nombres<?php $k ?>'><?php echo $row['nombre'] . $row['apellido'] ?></td>
                        <td id='fnacimiento<?php $k ?>'><?php echo $row['fnacimiento'] ?></td>
                        <td id='direccion<?php $k ?>'><?php echo $row['direccion'] ?></td>
                        <td id='email<?php $k ?>'><?php echo $row['email'] ?></td>
                        <td id='usuario<?php $k ?>'><?php echo $row['usuario'] ?></td>
                        <td id='password<?php $k ?>'><?php echo $row['password'] ?></td>
                        <td id='password<?php $k ?>'><?php echo $row['respuesta'] ?></td>
                        <td> <img onclick="eliminarCliente('<?php echo $row['cedula'] ?>')" alt='' src='../assets/images/icon-eliminar.png'>
                            <img onclick="Editar_usuario('<?php echo $row['cedula'] ?>')" alt='' src='../assets/images/icons-lapiz.gif'>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <button onclick=(Actualizar())>Actualizar</button>
        </div>
    </main>
    <?php include("./nav_footer_admin/footer.php"); ?>
</body>

</html>