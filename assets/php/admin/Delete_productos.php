<?php
include("../Conexion.php");
$db = new Conexion();

$codigo_producto = $_GET['codigo_producto'];

$sql = "DELETE FROM `producto` WHERE codigo_producto LIKE '$codigo_producto'";

$result = $db->OperSql($sql);

if ($result) {
   http_response_code(204);//todo correcto
} else {
   http_response_code(500);
}

?>