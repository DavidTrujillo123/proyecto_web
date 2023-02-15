<?php
include("../Conexion.php");
$db = new Conexion();

$cedula = $_GET['cedula'];

$sql = "DELETE FROM `cliente` WHERE cedula LIKE '$cedula'";
$result = $db->OperSql($sql);

if ($result) {
   echo ("
   
   <script>
   alert('Usuario eliminado correctamente');
   window.location = '../../../login_registro.php'; 
    </script>'");
} else {
   http_response_code(500);
}

?>