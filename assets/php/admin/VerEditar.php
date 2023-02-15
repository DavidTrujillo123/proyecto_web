<?php
    include("../Conexion.php");
    $db = new Conexion();
    
    $cedula = $_GET['cedula'];
    $sql = "SELECT cliente.cedula,nombre,apellido,fnacimiento,direccion,email,usuario,password,respuesta 
            FROM cliente, usuario 
            WHERE cliente.cedula LIKE '$cedula' AND cliente.cedula = usuario.cedula";
    $data = $db->Read($sql);

    echo json_encode($data);

    $db->closeConnection();
?>