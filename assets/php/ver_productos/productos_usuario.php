<?php
include("../Conexion.php");
$db = new Conexion();

$sql = "SELECT * FROM `producto`";
$data = $db->Read($sql);

echo json_encode($data);

$db->closeConnection();
?>