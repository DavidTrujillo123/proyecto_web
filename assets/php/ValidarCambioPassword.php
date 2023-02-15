<?php
include("./Conexion.php");

$db = new Conexion();

$usuario = $_GET["usuario"];
$respuesta = $_GET["respuesta"];

$sql = "SELECT * FROM `usuario` WHERE (usuario = '$usuario' OR email = '$usuario') 
        AND respuesta = '$respuesta';";

$validar_respuesta = $db->OperSql($sql);

$bandera = false;
if(mysqli_num_rows($validar_respuesta) > 0){
    $bandera = true;
}

echo json_encode($bandera);

?>