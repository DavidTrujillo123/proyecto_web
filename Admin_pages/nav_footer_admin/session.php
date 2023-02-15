<?php
  session_start();
  if(!isset($_SESSION['usuario'])){//Si no existe una sesión activa
    echo '
      <script>
        alert("Inicia sesión antes de ingresar");
        window.location = "../login_registro.php";
      </script>
      ';
    session_destroy();
    die();
  }
?>