<?php
    include("../Conexion.php");

    $db = new Conexion();
    
    $codigo_producto = $_POST['codigo_producto'];
    $nombre_producto = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    //tipo de variabes files, parecido a un arreglo 
    //tmp_name es una propiedad del tipo files, existen varias propiedad más
    $img = $_FILES['img']['tmp_name'];

    //addslashes -> es un método que agrega barras laterales invertidas entre caracteres 
    //especiales para proteger la consulta sql
    //file_get_contents -> ayuda a leer archivos y almacenar su contenido en una variable en PHP.
    $img = addslashes(file_get_contents($img));


    $sql = "INSERT INTO `producto`(`codigo_producto`, `nombre_producto`, `descripcion`, `cantidad`, `precio`, `img`) 
            VALUES ('$codigo_producto','$nombre_producto','$descripcion',
            '$cantidad','$precio','$img')";
    $data = $db->OperSql($sql);

    if($data){
        echo ('
            <script>
                alert("Producto añadido correctamente");
                window.location = "../../../Admin_pages/agregarProductos.php"; 
            </script>
        ');
    }else{
        echo ('
            <script>
                alert("Error por favor intente nuevo");
                window.location = "../../../Admin_pages/agregarProductos.php"; 
            </script>
        ');
    }

    $db->closeConnection();
?>