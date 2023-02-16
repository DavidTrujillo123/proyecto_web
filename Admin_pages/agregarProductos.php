<?php include("./nav_footer_admin/session.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script src="../assets/js/operacionesAdmin/admin_cliente.js"></script>
    <script src="../assets/js/operacionesAdmin/admin_producto.js"></script>
    <script src="../assets/js/operacionesAdmin/openPage.js"></script>
    <title>Admin - Agregar Productos</title>
</head>
<body>
    <?php include './nav_footer_admin/nav.php'; ?>
    <main id="principal">
        <div id="id_agregarProducto">
            <h1>Agregar Producto Nuevo</h1>
            <form action="../assets/php/admin/Insert_productos.php" method="POST" enctype="multipart/form-data">
                <div class="inicio_input">
                    <label for="codigo_producto">Código:</label>
                    <input type="text" name="codigo_producto" id="codigo_producto" value="" required><br>
                </div>
                <div class="inicio_input">    
                    <label for="nombre_producto">Nombre producto:</label>
                    <input type="text" name="nombre_producto" id="nombre_producto" value="" required><br>
                </div>
                <div class="inicio_input">
                    <label for="descripcion">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" value="" cols="40" rows="5" required ></textarea><br>
                </div>
                <div class="inicio_input">
                    <label for="precio">Precio:</label>
                    <input type="number" min="0" step=".01" name="precio" id="precio" value="" style="width : 150px;" required><br>
                </div>
                <div class="inicio_input">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" min="0" name="cantidad" id="cantidad" value="" style="width : 150px;" required><br>
                </div>
                <div class="inicio_input">
                    <label for="img">Imagen</label>
                    <input type="file" name="img" id="img" accept="image/png, image/jpg, image/jpeg" multiple required=""><br>
                </div>   
                <input type="submit" value="Actualizar" id="submit">
            </form>
        </div>
    </main>
    <?php include './nav_footer_admin/footer.php'; ?>
</body>
</html>