<?php
include("./nav_footer_admin/session.php");
include("../assets/php/Conexion.php");

$db = new Conexion();
$sql="SELECT * FROM `producto`";
$productos=$db->OperSql($sql);
$k = 0;
$stock = [];
$sin_stock = [];
$i = 0;
$j = 0;
foreach ($productos as $row) {
    if($row['cantidad'] > 0){
        $stock[$i] = $row;
        $i++;
    }else{
        $sin_stock[$j] = $row;
        $j++;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script src="../assets/js/operacionesAdmin/admin_producto.js"></script>
    <script src="../assets/js/operacionesAdmin/openPage.js"></script>
    <title>Admin - Inventario</title>
</head>
<body>

    <?php include './nav_footer_admin/nav.php'; ?>
    <main id="principal">
        <div id="id_inventario">
            <div id="tablas">
                <h1>Inventario Productos</h1>
                <h2>Productos en stock</h2>
                <table id="tabla_productos">
                    <tr>
                        <th>Código</th>
                        <th>Nombre producto</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                <?php foreach ($stock as $row) { ?> 
                        <tr>
                            <td id='codigo_producto<?php $k ?>'><?php echo $row['codigo_producto']?></td>
                            <td id='nombre_producto<?php $k ?>'><?php echo $row['nombre_producto']?></td>
                            <td id='descripcion<?php $k ?>'><?php echo $row['descripcion']?></td>
                            <td id='precio<?php $k ?>'><?php echo $row['precio']?></td>
                            <td id='cantidad<?php $k ?>'><?php echo $row['cantidad']?></td>
                            <td id='img<?php $k ?>'><img src="data:image/jpg;base64,<?php echo base64_encode($row['img']); ?>" width="100" height="100" loading="lazy" alt="Animi Dolor Pariatur" class="img-cover"></td>
                            <td> <img onclick="eliminarProducto('<?php  echo $row['codigo_producto'] ?>')" alt='' src='../assets/images/icon-eliminar.png'>
                                <img onclick="Editar_producto('<?php  echo $row['codigo_producto']?>')" alt='' src='../assets/images/icons-lapiz.gif'></td>
                              <?php $k++ ?>  
                        </tr>   
                    <?php } ?>
                </table>
                <h2>Productos agotados</h2>
                <table id="tabla_agotados">
                    <tr>
                        <th>Código</th>
                        <th>Nombre producto</th>
                        <th>Descripción</th>    
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                    <?php foreach ($sin_stock as $row) { ?>
                        <tr>
                            <td id='codigo_producto<?php $k ?>'><?php echo $row['codigo_producto']?></td>
                            <td id='nombre_producto<?php $k ?>'><?php echo $row['nombre_producto']?></td>
                            <td id='descripcion<?php $k ?>'><?php echo $row['descripcion']?></td>
                            <td id='precio<?php $k ?>'><?php echo $row['precio']?></td>
                            <td id='cantidad<?php $k ?>'><?php echo $row['cantidad']?></td>
                            <td id='img<?php $k ?>'><img src="data:image/jpg;base64,<?php echo base64_encode($row['img']); ?>" width="100" height="100" loading="lazy" alt="Animi Dolor Pariatur" class="img-cover"></td>
                            <td> <img onclick="eliminarProducto('<?php  echo $row['codigo_producto'] ?>')" alt='' src='../assets/images/icon-eliminar.png'>
                                <img onclick="Editar_producto('<?php  echo $row['codigo_producto']?>')" alt='' src='../assets/images/icons-lapiz.gif'></td>
                              <?php $k++ ?>  
                        </tr>      
                    <?php } ?>
                </table>
            </div>
        </div>
    </main>
    <?php include './nav_footer_admin/footer.php'; ?>
</body>
</html>