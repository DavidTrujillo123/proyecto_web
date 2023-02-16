<?php
  include("./nav_footer_admin/session.php");
  include("../assets/php/Conexion.php");  
  $db = new Conexion();
  //# clientes
  $sql = "SELECT * FROM `cliente`";
  $res = $db->OperSql($sql);
  $num_clientes = $res->num_rows;

  $sql = "SELECT * FROM `producto`";
  $res = $db->OperSql($sql);
  $num_productos = $res->num_rows;

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Admin - Tienda</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script src="../assets/js/operacionesAdmin/admin_cliente.js"></script>
    <script src="../assets/js/operacionesAdmin/admin_producto.js"></script>
    <script src="../assets/js/operacionesAdmin/openPage.js"></script>
    
  </head>
  <body>
    <?php include './nav_footer_admin/nav.php'; ?>
    <main id="principal">
      <div id="panel_inicio">
        <h1>Bienvenido al panel de administrador de la tienda</h1>
        <div id="cantidad">
          <div class="carta">
              <h2>Usuario: <?php echo $num_clientes ?></h2>
          </div>
          <div class="carta">
              <h2>Productos: <?php echo $num_productos ?></h2>
          </div>
        </div>
      </div>

      <!-- <div id="panel_inventario"></div>
      <div id="panel_agregar"></div>
      <div id="clientes"></div> -->

    </main>
    <?php include './nav_footer_admin/footer.php'; ?>
    
  </body>
</html>