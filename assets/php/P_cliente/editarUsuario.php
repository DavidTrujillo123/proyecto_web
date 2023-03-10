<?php
include("../Conexion.php");

session_start();
if (!isset($_SESSION['usuario'])) { //Si no existe una sesión activa
  echo '
      <script>
        alert("Inicia sesión antes de ingresar");
        window.location = "./login_registro.php";
      </script>
      ';
  session_destroy();
  die();
}

$usuario = $_SESSION['usuario']; //asigna la sesión al usuario
$db = new Conexion();

$sql = "SELECT * FROM usuario WHERE usuario LIKE '$usuario' or email LIKE '$usuario'";
$resultado_usuario  = $db->Read($sql);
$cedula = $resultado_usuario[0]['cedula'];

$sql = "SELECT nombre, apellido, direccion,fnacimiento FROM cliente WHERE cedula LIKE '$cedula'";
$resultado_cliente = $db->Read($sql);
$nombre = $resultado_cliente[0]['nombre'];
$apellido = $resultado_cliente[0]['apellido'];
$direccion = $resultado_cliente[0]['direccion'];
$fnacimiento = $resultado_cliente[0]['fnacimiento'];
?>



<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/estilo_paginaCliente.css">
    <link rel="stylesheet" href="../../css/EditUser.css">
    <link rel="shortcut icon" href="./assets/css/favicon.svg" type="image/svg+xml">

    <!-- 
  - custom css link
-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


    <!-- 
  - google font link
-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Mr+De+Haviland&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> -->


    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <!-- <link rel="stylesheet" href="../../css/tabla.css" /> -->


    <title>Editar Perfil</title>

</head>
<body>  
  <?php include('../../../footer_nav_cliente/nav_clientes.php');?>
    <div class="profile">
        <div class="content">
          <h1>Editar Perfil</h1>
          <form id="IDform" action="../usuarios/Update_editarClientes.php" method = 'POST'>   

          <?php foreach($resultado_usuario as $row){ ?>
            <!--nombre-->
            <fieldset>
              <div class="grid-35">
                <label for="fname">Nombres</label>
              </div>
              <div class="grid-65">
                <input name="nombre" type="text" id="IDnombre" value = "<?php echo $nombre;?>"/>
              </div>
            </fieldset>
            
            <!--apellido-->
            <fieldset>
              <div class="grid-35">
                <label for="lname">Apellidos</label>
              </div>
              <div class="grid-65">
                <input name="apellido" type="text" id="IDapellido" value = "<?php echo $apellido;?>"/>
              </div>
            </fieldset>

            <!--cedula-->
            <fieldset>
                <div class="grid-35">
                  <label for="cedula">Cédula</label>
                </div>
                <div class="grid-65">
                  <input name="cedula" type="text" id="IDcedula" value = "<?php echo $cedula;?>" readonly/>
                </div>
              </fieldset>


            <!--usuario-->
            <fieldset>
              <div class="grid-35">
                <label for="location">Nombre de Usuario:</label>
              </div>
              <div class="grid-65">
                <input name="usuario" type="text" id="IDusuario" value = "<?php echo $row['usuario'];?>" readonly/>
              </div>
            </fieldset>
            

            <!--direccion-->
            <fieldset>
                <div class="grid-35">
                  <label for="location">Dirección:</label>
                </div>
                <div class="grid-65">
                  <input name="direccion" type="text" id="IDdireccion" value = "<?php echo $direccion;?>"/>
                </div>
            </fieldset>

            <!--fnacimiento-->
            <fieldset>
              <div class="grid-35">
                <label for="location">Fecha de Nacimiento:</label>
              </div>
              <div class="grid-65">
                <input name="fnacimiento" type="date" id="IDfnacimiento" value = "<?php echo $fnacimiento?>"/>
              </div>
          </fieldset>


            <!--email-->
            <fieldset>
              <div class="grid-35">
                <label for="email">Correo Electrónico:</label>
              </div>
              <div class="grid-65">
                <input name="email" type="email" id="IDemail" value = "<?php echo $row['email']?>" readonly/>
              </div>
            </fieldset>


            <!--respuesta-->
            <fieldset>
              <div class="grid-35">
                <label for="pregunta">¿Cómo se llamó tu primera escuela?</label>
              </div>
              <div class="grid-65">
                <input name="respuesta" type="text" id="IDrespuesta" value = "<?php echo $row['respuesta']?>"/>
              </div>
            </fieldset>


            <!--password-->
            <fieldset>
                <div class="grid-35">
                  <label for="email">Contraseña</label>
                </div>
                <div class="grid-65">
                  <input name="password" type="password" id="IDpassword" value = "<?php echo $row['password']?>" />
                </div>
              </fieldset>

            <!-- repeatPassword -->
            <fieldset>
                <div class="grid-35">
                  <label for="email">Repetir Contraseña </label>
                </div>
                <div class="grid-65">
                  <input name="repeatPassword" type="password" id="IDrepeatPassword" value = "<?php echo $row['password']?>" />
                </div>
              </fieldset>
            <!-- Website URL -->
            
            <fieldset id="botones">
              <input type="button" class="Btn cancel" value="Cancelar"  onclick = "location.href = '../../../pagina_cliente.php'"/>
              <input type="submit" class="Btn" value="Guardar Cambios" />
              <input type="button" class="Btn" value="Eliminar Cuenta" onclick = "location.href = '../usuarios/eliminarUsuario.php?<?php echo $row['cedula']?>'"/>    
            </fieldset>

          <?php } ?>
          </form>
        </div>
      </div>

      <!--Footer-->
      <!-- <footer id="foot">
        <div class="grupo-1">
            <div class="box">
                <figure>
                    <a href="#">
                        <img src="../../../assets/images/logo2.png" alt="Logo de La Lico">
                    </a>
                </figure>
            </div>
            <div class="box">
                <h2>SOBRE NOSOTROS</h2>
                <p>La Lico es una licorería dedicado a brindar a sus clientes una amplia variedad de bebidas alcohólicas de alta calidad a precios competitivos.</p>
                
            </div>
            <div class="box">
                <h2>SÍGUENOS</h2>
                <div class="red-social">
                    <a href="https://www.facebook.com/lalicolicoresibarra" class="fa fa-facebook" target="_blank"></a>
                    <a href="https://www.instagram.com/lalicocruzverde/" class="fa fa-instagram" target="_blank"></a>
                    <a href="https://wa.me/593961971500" class="fa fa-whatsapp" target="_blank"></a>
                </div>
            </div>
        </div>
        <div class="grupo-2">
            <small> &copy; 2023 <b>La Lico</b> - Todos los Derechos Reservados</small>
        </div>
    </footer> -->
    <?php include('../../../footer_nav_cliente/footer.php');?>

    <script src="../../js/validarDatosEditar.js"></script>
    <script src="../../js/paginaCliente.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>

