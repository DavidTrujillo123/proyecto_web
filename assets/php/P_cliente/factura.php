<?php

include("../Conexion.php");
include("plantilla.php");
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
$sql1 = "SELECT id_usuario FROM usuario WHERE usuario= '$usuario' or email='$usuario'";
$cliente = $db->Read($sql1);
$id_usuario = $cliente[0]['id_usuario'];

//busca el nombre y apellido con la cedula en la tabla cliente
$sql = "SELECT nombre, apellido,direccion FROM cliente WHERE cedula = '$cedula'";
$cliente = $db->Read($sql);
$nombres = $cliente[0]['nombre'] . ' ' . $cliente[0]['apellido'];
$direccion=$cliente[0]['direccion'];
$Total=0;
$echa=date("d/m/y");
$RestarCantidad=0;

$sql = "SELECT * FROM producto,carrito_item,carrito WHERE carrito_item.id_carrito=carrito.id_carrito 
        AND producto.codigo_producto=carrito_item.codigo_producto AND carrito.id_usuario=$id_usuario ";

$resultado= $db->OperSql($sql);


$PDF=new PDFF("P", "mm", "A4");
$PDF->AliasNbPages();
$PDF->SetMargins(15,15,15);
$PDF->AddPage();

//Cliennete

$PDF->SetFillColor(225);
$PDF->SetFont('Arial','B',14);
$PDF->SetDrawColor(128,0,0);
$PDF->Cell(0,10,$nombres,1,1,'C');
$PDF->Cell(90,10,'C.I:'.$cedula,1,0,'L');
$PDF->Cell(90,10,'Direccion:'.$direccion,1,1,'L');
$PDF->Ln(10);
//Tabla de productos
$PDF->SetFont("Arial", "B", 16);
$PDF->Cell(20,10,'Cant.',1,0,'L');
$PDF->Cell(75,10,'Descripcion',1,0,'L');
$PDF->Cell(45,10,'Precio Unitario.',1,0,'L');
$PDF->Cell(40,10,'Precio Total',1,1,'C');

$PDF->SetFont("Arial", "", 12);
while($fila=$resultado->fetch_assoc()){
    $Total = $Total + $fila['subtotal'];
  
    $PDF->Cell(20,5,$fila['cantidad_cliente'],1,0,'C');
    $PDF->Cell(75,5,$fila['nombre_producto'],1,0,'C');
    $PDF->Cell(45,5,$fila['precio'],1,0,'L');
    $PDF->Cell(40,5,$fila['subtotal'],1,1,'R');
   //  $PDF->Cell(40,5,$fila[''],1,1,'C');

   //Actualizar cantidad productos
   $RestarCantidad=$fila['cantidad'] - $fila['cantidad_cliente'];
    $codigo=$fila['codigo_producto'];
 
     
   $sql2="UPDATE producto SET cantidad = $RestarCantidad WHERE codigo_producto = $codigo";
 
      
   $operaciones=$db->OperSql($sql2);
   //Crear nuevo carrito
<<<<<<< Updated upstream
    $numeroFactura+=01;
=======
  $eliminar=$fila['id_carrito'] ;

   $sql="DELETE FROM carrito_item WHERE id_carrito =$eliminar ";
   
   $operaciones=$db->OperSql($sql);
>>>>>>> Stashed changes

}

$IVA=0.11*$Total;
$TotalCompra=$IVA+$Total;

$PDF->Ln(10);

$PDF->SetX(135);$PDF->Cell(20,5,'Subtotal:',0,0,'R');
$PDF->Cell(40,5,'$'.$Total,0,1,'R');
$PDF->SetX(135);$PDF->Cell(20,5,'I.V.A. 12%:',0,0,'R');
$PDF->Cell(40,5,'$'.$IVA,0,1,'R');
$PDF->SetFont("Arial", "B", 13);
$PDF->SetX(135); $PDF->Cell(20,15,'TOTAL:',0,0,'R');
$PDF->SetFont("Arial", "", 13);
$PDF->Cell(40,15,'$'.$TotalCompra,0,1,'R');
$PDF->Output();