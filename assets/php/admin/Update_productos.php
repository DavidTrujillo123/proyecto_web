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

function VerficarData($data){
    if($data){
        echo ('
            <script>
                alert("Producto actualizado correctamente");
                window.location = "../../../Admin_pages/inventario.php"; 
            </script>
        ');
    }
    else {
        echo ('
            <script>
                alert("Error: Ingrese nuevamente los datos");
                window.location = "../../../Admin_pages/inventario.php"; 
            </script>
        ');
        exit();//termina el script
    }
}


if($img!=""){//imagen nueva 
    //addslashes -> es un método que agrega barras laterales invertidas entre caracteres 
    //especiales para proteger la consulta sql
    //file_get_contents -> ayuda a leer archivos y almacenar su contenido en una variable en PHP.
    $img = addslashes(file_get_contents($img));
    
    //Update en la tabla productos
    $sql = "UPDATE `producto` 
        SET `nombre_producto`='$nombre_producto',`descripcion`='$descripcion',
            `cantidad`='$cantidad',`precio`='$precio',`img`='$img' 
        WHERE codigo_producto LIKE '$codigo_producto'";
}
else{//no actualiza la imagen
    $sql = "UPDATE `producto` 
        SET `nombre_producto`='$nombre_producto',`descripcion`='$descripcion',
            `cantidad`='$cantidad',`precio`='$precio' 
        WHERE codigo_producto LIKE '$codigo_producto'";
}

$data = $db->OperSql($sql);
VerficarData($data);


$db->closeConnection();

?>