<?php
include("./assets/php/Conexion.php");

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
//busca la cedula, sea con el nombre de usuario o email en la tabla usuario
$sql = "SELECT cedula FROM usuario WHERE usuario= '$usuario' or email='$usuario'";
$cliente = $db->Read($sql);
$cedula = $cliente[0]['cedula'];
//busca el nombre y apellido con la cedula en la tabla cliente
$sql = "SELECT nombre, apellido FROM cliente WHERE cedula = '$cedula'";
$cliente = $db->Read($sql);
$nombres = $cliente[0]['nombre'] . ' ' . $cliente[0]['apellido']; //guarda los datos en una variable

$sql = "SELECT * FROM `producto`";//selecciona todos los productos

$productos = $db->OperSql($sql);

$sql1 = "SELECT id_usuario FROM usuario WHERE usuario= '$usuario' or email='$usuario'";//selecciona el id usuario
$usuario1 = $db->Read($sql1);
$id_usuario = $usuario1[0]['id_usuario'];

$sql = "SELECT * FROM carrito WHERE carrito.id_usuario=$id_usuario ";
$res = $db->OperSql($sql);
$num_carrito = $res->num_rows;
$num_carrito = $num_carrito-1;
$res = $res->fetch_all(MYSQLI_ASSOC);
$id_carrito = $res[$num_carrito]['id_carrito'];

$sql = "SELECT * FROM carrito_item, carrito WHERE carrito_item.id_carrito=carrito.id_carrito AND carrito.id_carrito='$id_carrito'";
$res = $db->OperSql($sql);
$num_productos = $res->num_rows;//numero de productos para el boton del carro que se agregaron

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- 
    - primary meta tag
  -->
  <title>La Lico</title>
  <meta name="title" content="La lico Ibarra">
  <meta name="description" content="Tienda Online de licores">

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./assets/css/favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/estilo_paginaCliente.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="./assets/css/CssFooter.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Mr+De+Haviland&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">


  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
  <!--Iconos Footer-->
  <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script> 
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <div class="input-wrapper">
        <a href="#"><img src="./assets/images/logo3.png" class="logo" alt=""></a>
      </div>

      <h2 class="section-title">La Lico Store</h2>

      <div class="header-action">

        <button class="header-action-btn" aria-label="user" onclick="location.href='./assets/php/P_cliente/editarUsuario.php'">
          <ion-icon name="person-outline" aria-hidden="true"></ion-icon>
        </button>




        <a href="./assets/php/P_cliente/carrito.php" class="header-action-btn" aria-label="cart">
          <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
          <span id="num_cart" class="btn-badge"><?php echo $num_productos ?></span>
        </a>

        <button class="header-action-btn" aria-label="open menu" data-nav-toggler>
          <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
        </button>

      </div>

    </div>
  </header>





  <!-- 
    - #SIDEBAR
  -->

  <div class="sidebar" data-navbar>

    <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
      <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
    </button>


    <nav class="navbar">
      <ul class="navbar-list">

        <li class="navbar-item">
          <a href="#home" class="navbar-link" data-nav-link>Inicio</a>
        </li>

        <li class="navbar-item">
          <a href="#product" class="navbar-link" data-nav-link>Productos</a>
        </li>

        <li class="navbar-item">
          <a href="./assets/php/CerrarSesion.php" class="navbar-link" data-nav-link>Cerrar Sesion</a>
        </li>


      </ul>
    </nav>

    <ul class="contact-list">

      <li>
        <p class="contact-list-title">Contáctanos</p>
      </li>

      <li class="contact-item">
        <address class="address">
          Av.Atahualpa 18-80 y Tobias Mena , Ibarra
        </address>
      </li>

      <li class="contact-item">
        <a href="mailto:support.center@woodex.co" class="contact-link">lalicolicores@hotmail.com</a>
      </li>

      <li class="contact-item">
        <a href="tel:00001235567890" class="contact-link">099 252 9126</a>
      </li>

    </ul>

    <div class="social-wrapper">

      <p class="social-list-title">Síganos en las redes sociales</p>

      <ul class="social-list">

        <li>
          <a href="https://www.facebook.com/lalicolicoresibarra/" class="social-link">
            <ion-icon name="logo-facebook"></ion-icon>
          </a>
        </li>

        <li>
          <a href="https://mobile.twitter.com/licoreria" class="social-link">
            <ion-icon name="logo-twitter"></ion-icon>
          </a>
        </li>

        <li>
          <a href="https://www.instagram.com/p/CFupNESpLrZ/" class="social-link">
            <ion-icon name="logo-instagram"></ion-icon>
          </a>
        </li>

      </ul>

    </div>

  </div>

  <div class="overlay" data-overlay data-nav-toggler></div>





  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section id="hero">
        <h4>LOS MEJORES DISTRIBUIDORES DEL PAIS</h4>
        <h2>BIENVENIDO</h2>
        <h1><?php echo $nombres ?></h1>

      </section>



      <!-- 
        - #ABOUT
      -->

      <section class="section about" id="about" aria-label="about">
        <div class="container">

          <h2 class="section-title">ADVERTENCIA</h2>

          <p class="section-text">
            "Advertencia sobre el consumo de alcohol: El consumo excesivo de alcohol puede tener graves
            consecuencias para su salud y bienestar. El alcohol puede dañar el cerebro, el hígado y el corazón,
            y puede aumentar el riesgo de enfermedades mentales y trastornos de la memoria. Si bebe, hágalo con moderación
            y siempre siguiendo las recomendaciones de la OMS sobre el consumo de alcohol.
            Por favor, beba responsablemente y busque ayuda si cree que tiene un problema con el alcohol."
          </p>

          <div class="about-card">
            <figure class="card-banner img-holder" style="--width: 1170; --height: 500;">

              <video src="./assets/images/lalicovideo.mp4" poster="presentacion.jpg" width="1170" height="500" loading="lazy" alt="Woodex promo" class="img-cover" autoplay muted controls></video>

            </figure>


          </div>

        </div>
      </section>





      <!-- 
        - #PRODUCTS
      -->

      <section class="section product" id="product" aria-label="product">
        <div class="container">

          <div class="title-wrapper">
            <h2 class="h2 section-title">Productos</h2>


          </div>

          <ul class="grid-list product-list" data-filter="all">
            <?php foreach ($productos as $row) { ?>


              <li class="decoration">
                <div class="product-card">
                  <a class="card-banner img-holder has-before" style="--width: 300; --height: 300;">
                    <img src="data:image/jpg;base64,<?php echo base64_encode($row['img']); ?>" width="300" height="300" loading="lazy" alt="Animi Dolor Pariatur" class="img-cover">

                    <ul class="card-action-list">


                      <li>
                        <?php
                        $sql1 = "SELECT cantidad FROM producto WHERE codigo_producto='$row[codigo_producto]';";

                        $cantidad = $db->Read($sql1);
                        $cantidadUnit = $cantidad[0]['cantidad'];
                        if ($cantidadUnit > 0) {

                        ?>
                          <button onclick="location.href='./assets/php/P_cliente/carrito.php?agregar=<?php echo print_r($row['codigo_producto'], true) ?>'" class="card-action-btn" aria-label="add to cart" title="añadir al carrito">
                            <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                          </button>
                        <?php } else { ?>
                          <button class="card-action-btn" aria-label="add to whishlist" title="No disponible">
                            <span class="material-symbols-outlined">
                              block
                            </span>
                          </button>

                        <?php } ?>


                      </li>



                    </ul>
                  </a>

                  <div class="card-content">
                    <h3 class="h3">
                      <a href="" class="card-title"><?php echo $row['nombre_producto'] ?></a>
                      <p class="card-text"><?php echo $row['descripcion'] ?></p>
                    </h3>

                    <div class="card-price">

                      <data class="price" value="10"><?php echo  $row['precio'] ?></data>
                    </div>


                  </div>

                </div>
              </li>
            <?php } ?>



          </ul>


        </div>
      </section>


      <!-- 
    - #BACK TO TOP
  -->

      <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
        <ion-icon name="arrow-up" aria-hidden="true"></ion-icon>
      </a>





      <!-- 
    - custom js link
  -->
      <script src="./assets/js/paginaCliente.js" defer></script>




      <!-- 
    - ionicon link
  -->
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

      <!--FOOTER-->
      <footer id="foot">
        <div class="grupo-1">
          <div class="box">
            <figure>
              <a href="#">
                <img src="./assets/images/logo2.png" alt="Logo de La Lico">
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
      </footer>
</body>

</html>