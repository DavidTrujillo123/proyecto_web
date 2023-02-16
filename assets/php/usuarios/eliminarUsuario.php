<?php
include("../Conexion.php");
$db = new Conexion();

$cedula = $_GET['cedula'];

echo("
   <script>
   function ConfirmDemo() {
      //Ingresamos un mensaje
      var mensaje = confirm('¿Estás seguro que quieres eliminar esta cuenta?');
      //Verificamos si el usuario acepto el mensaje
      if (mensaje) {".eliminarUsuario()."
      }
      //Verificamos si el usuario denegó el mensaje
      else {
      alert('¡Haz denegado la eliminación de la cuenta');
      }
   }
   </script>

");


function eliminarUsuario(){
   global $cedula;
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
}

?>