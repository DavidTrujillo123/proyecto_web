<?php

//seguridad al momento de iniciar sesión
session_start();

include("../Conexion.php");

$db = new Conexion();

$usuario = $_POST['usuario'];//hace referencia al email o al nombre de usuario
$password = $_POST['password'];

$sql = "SELECT * FROM `usuario` 
        WHERE (`usuario` LIKE '$usuario' or `email` LIKE '$usuario') and `password` LIKE '$password'";

$validar_login = $db->OperSql($sql);

//Expresion regular para que inicie con A y despues números para los admins
$bandera = preg_match("/^A\d+$/", "$usuario");

if(mysqli_num_rows($validar_login) > 0){ // si existe una row 
    $_SESSION['usuario'] = $usuario;//OJOOO
    if($bandera){//administrador
        echo'
            <script>
                alert("INICIO DE SESION EXITOSO ADMINISTRADOR");
                window.location = "../../../Admin_pages/admin.php";    
            </script>
        ';
    }   
    else {//Cliente
        echo'
            <script>
                alert("INICIO DE SESION EXITOSO");
                window.location = "../../../pagina_cliente.php";    
            </script>
        '; 
    }
    exit;
}
else {//Si no coincide el usuario y contraseña o no existe el usuario
    echo '
    <script>
        alert("USUARIO INEXISTENTE, VERIFIQUE LA CONTRASEÑA O EL CORREO");
        window.location = "../../../login_registro.php";    
    </script>
    ';
    session_destroy();
    exit;
}
