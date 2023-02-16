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
$numeroFactura=0;
$fecha=date("y/m/d");
$RestarCantidad=0;
//busca el id del carrito 

$sql_carrito = "SELECT id_carrito FROM carrito WHERE carrito.id_usuario=$id_usuario";
$cart = $db->Read($sql_carrito);
$car1 = $db->OperSql($sql_carrito);//obtener las filas del carrito
$nrows = $car1->num_rows;
$nrows = $nrows-1;	//ultima fila del carrito
$id_carrito = $cart[$nrows]['id_carrito'];


//Buscamos los
$sql = "SELECT * FROM producto,carrito_item,carrito WHERE carrito_item.id_carrito=carrito.id_carrito 
        AND producto.codigo_producto=carrito_item.codigo_producto AND carrito.id_carrito=$id_carrito";


$resultado= $db->OperSql($sql);


$PDF=new PDFF("P", "mm", "A4");
$PDF->AliasNbPages();
$PDF->SetMargins(15,15,15);
$PDF->AddPage();

//Cliente

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
   $id_cliente=$fila['id_carrito'];

     
   $sql2="UPDATE producto SET cantidad = $RestarCantidad WHERE codigo_producto = $codigo";
 
      
   $operaciones=$db->OperSql($sql2);
 
   

}

$IVA=0.11*$Total;
$TotalCompra=$IVA+$Total;

//Insertar factura
$sql3="INSERT INTO factura(id_factura,id_carrito,Nfactura, fecha_compra, subtotal, total) 
VALUES (null,'$id_carrito','$numeroFactura','$fecha','$Total','$TotalCompra')";
  $opera=$db->OperSql($sql3);
//Crear Carrito

$sql="INSERT INTO `carrito`(`id_carrito`, `id_usuario`) VALUES (null,$id_usuario)";
$opera=$db->OperSql($sql);

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