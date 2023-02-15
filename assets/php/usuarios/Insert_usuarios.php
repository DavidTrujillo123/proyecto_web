<?php
include("../Conexion.php"); 

$db = new Conexion();
$bandera = false;

//Datos del formulario
$cedula = $_POST['cedula'];
$nombre = $_POST['nombre']; 
$apellido = $_POST['apellido']; 
$fnacimiento = $_POST['fnacimiento'];
$ciudad = $_POST['ciudad'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];
$usuario = $_POST['usuario'] ; 
$password = $_POST['password'];
$respuesta = $_POST['respuesta'];


$ciudad_direccion = $ciudad.", ".$direccion;

$bandera_admin = preg_match("/^A\d+$/", "$usuario");



function VerificarRepetidos($sql){
    global $db;
    $verificar = $db->OperSql($sql);
    if(mysqli_num_rows($verificar) > 0){ // si existe una row 
        echo'
            <script>
                alert("Error: Usuario ya registrado");
                window.location = "../../../login_registro.php";    
            </script>
        ';
        exit();//termina el script
    }
}

function VerficarData($data){
    global $bandera;
    if($data){
        $bandera = true;
    }
    else {
        echo ('
            <script>
                alert("Error: Ingrese nuevamente sus datos");
            </script>
        ');
        exit();//termina el script
    }
}


//Verifica si la cedula esta repetida
$sql = "SELECT * FROM cliente WHERE cedula LIKE '$cedula'";
VerificarRepetidos($sql);

 //Verificar si el email de la tabla usuario ya esta ingresado o no para que no existan usuarios repetidos
$sql = "SELECT * FROM usuario WHERE email LIKE '$email'";
VerificarRepetidos($sql);


//Verifica que el nombre de usario ingresado no se repita de los existentes en la tabla usuario
$sql = "SELECT * FROM usuario WHERE usuario LIKE '$usuario' ";
VerificarRepetidos($sql);

//Insercion en la tabla de cliente
$sql = "INSERT INTO `cliente`(`cedula`, `nombre`, `apellido`, `fnacimiento`, `direccion`) 
        VALUES ('$cedula','$nombre','$apellido','$fnacimiento','$ciudad_direccion')";
$data = $db->OperSql($sql);
VerficarData($data);

//Insercion en la tabla de usuario
$sql = "INSERT INTO `usuario`(`cedula`, `email`, `usuario`, `password`, `respuesta`) 
        VALUES ('$cedula','$email','$usuario','$password', '$respuesta')";
$data = $db->OperSql($sql);
VerficarData($data);

//Creacion de carrito y vinculacion en la tabla de cliente
$sql = "INSERT INTO `carrito`(`id_usuario`) VALUES (LAST_INSERT_ID())";//LAST_INSET_ID() es una funcion sql
$data = $db->OperSql($sql);
VerficarData($data);

if($bandera) {
    echo ('
    <script>
        alert("Usuario ingresado correctamente, por favor inicie sesión");
        window.location = "../../../login_registro.php";
    </script>
    ');    
}

$db->closeConnection();

?>
