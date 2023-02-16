<?php
include("../Conexion.php");
$db = new Conexion();

$bandera = false;
echo("
   <script>
         var mensaje = confirm('¿Estás seguro que quieres eliminar esta cuenta?');
   </script>
");

if(isset($_GET['mensaje'])){
   $bandera= $_GET['mensaje'];
} 

if($bandera){
   $cedula = $_GET['cedula'];
   $sql = "DELETE FROM `cliente` WHERE cedula LIKE '$cedula'";
   $result = $db->OperSql($sql);

   if ($result) {
      echo ("
      
      <script>
      alert('Usuario eliminado correctamente');
      window.location = '../../../index.html'; 
      </script>'");
   } else {
      http_response_code(500);
   }
}else{
   echo ("
      <script>
      alert('Gil');
      window.location = '../../../editarUsuario.php';
      </script>'");
}
?>