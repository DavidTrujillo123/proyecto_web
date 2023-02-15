<?php
include("../Conexion.php");
$db = new Conexion();

$cedula = $_GET['cedula'];

$sql = "DELETE FROM `cliente` WHERE cedula LIKE '$cedula'";
$result = $db->OperSql($sql);

if ($result) {
   http_response_code(204);//todo correcto
} else {
   http_response_code(500);
}

?>