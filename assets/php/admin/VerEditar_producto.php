<?php
    include("../Conexion.php");
    $db = new Conexion();
    
    $codigo_producto = $_GET['codigo_producto'];
    $sql = "SELECT `codigo_producto`, `nombre_producto`, `descripcion`, `cantidad`, `precio`
            FROM `producto` WHERE codigo_producto LIKE '$codigo_producto'";
    $data = $db->Read($sql);
    
    echo json_encode($data);

    $db->closeConnection();
?>