<?php
include("./Conexion.php");

$db = new Conexion();

$usuario = $_POST['usuario'];
$password = $_POST['password'];
$repeatPassword = $_POST['repeatPassword'];

$bandera = preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}$/", "$password");

if($bandera && $password == $repeatPassword){
    $sql = "UPDATE `usuario` SET `password`='$password' WHERE (usuario ='$usuario') OR (email = '$usuario');";

    $data = $db->OperSql($sql);
    if($data){
        echo('<script>
            alert("Contraseña actualizada correctamente");
            window.location = "../../login_registro.php"; 
        </script>
        ');
    }
    else {
        echo('<script>
            alert("Algo salió mal, por favor intente de nuevo");
            window.location = "../../login_registro.php"; 
        </script>
        ');
        exit();
    }
}
else{
    echo('<script>
            alert("Asegurese de que las contraseñas coincidan y tenga mayusculas, minusculas y numeros");
            window.location = "../../login_registro.php"; 
        </script>
        ');
        exit();
}





$db->closeConnection();
?>