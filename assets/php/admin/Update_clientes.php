<?php
include("../Conexion.php");
$db = new Conexion();
$bandera = false;

$cedula = $_POST['cedula'];
$nombre = $_POST['nombre']; 
$apellido = $_POST['apellido']; 
$fnacimiento = $_POST['fnacimiento'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];
$usuario = $_POST['usuario'] ; 
$password = $_POST['password'];
$respuesta = $_POST['respuesta'];

function VerficarData($data){
    global $bandera;
    if($data){
        $bandera = true;
    }
    else {
        echo ('
            <script>
                alert("Error: Ingrese nuevamente sus datos");
                window.location = "../../../Admin_pages/admin_cliente.php"; 
            </script>
        ');
        exit();//termina el script
    }
}

//Update en la tabla cliente
$sql = "UPDATE `cliente` 
        SET `cedula`='$cedula',`nombre`='$nombre',`apellido`='$apellido',
        `fnacimiento`='$fnacimiento',`direccion`='$direccion' 
        WHERE cedula LIKE '$cedula'";
$data = $db->OperSql($sql);
VerficarData($data);

//Update en la tabla usuario
$sql = "UPDATE `usuario` 
        SET `cedula`=$cedula,`email`='$email',`usuario` LIKE '$usuario',`password` LIKE '$password',`respuesta` LIKE '$respuesta' 
        WHERE cedula LIKE '$cedula'";
$data = $db->OperSql($sql);
VerficarData($data);

if($bandera){
    echo ('
    <script>
        alert("Usuario actualizado correctamente");
        window.location = "../../../Admin_pages/admin_cliente.php"; 
    </script>
    ');
}

$db->closeConnection();

?>