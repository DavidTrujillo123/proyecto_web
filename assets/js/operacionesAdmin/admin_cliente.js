// function Limpiar(){
//     let tabla = document.getElementById("tabla_clientes");
//     tabla.innerHTML = `<tr>
//     <th>Cédula</th>
//     <th>Nombres</th>
//     <th>Fecha nacimiento</th>
//     <th>Direccion</th>
//     <th>Correo Electrónico</th>
//     <th>Usuario</th>
//     <th>Contraseña</th>
//     <th>Respuestas</th>
//     <th>Acciones</th>
//     </tr>`;
// }

// function verData_usuarios(){
//     fetch("../assets/php/admin/Data_clientes.php")
//     .then(response => response.json())
//     .then(data => { //archivo json
//         let tabla = document.getElementById("tabla_clientes");
//         let k = 0;
//         for(let obj in data){
//             tabla.innerHTML += '<td id="cedula'+k+'">'+data[obj].cedula+'</td>'
//                 +'<td id="nombres'+k+'">'+data[obj].nombre+" "+data[obj].apellido+'</td>'
//                 +'<td id="fnacimiento'+k+'">'+data[obj].fnacimiento+'</td>'
//                 +'<td id="direccion'+k+'">'+data[obj].direccion+'</td>'
//                 +'<td id="email'+k+'">'+data[obj].email+'</td>'
//                 +'<td id="usuario'+k+'">'+data[obj].usuario+'</td>'
//                 +'<td id="password'+k+'">'+data[obj].password+'</td>'
//                 +'<td id="password'+k+'">'+data[obj].respuesta+'</td>'
//                 +"<td> <img onclick='eliminarCliente("+data[obj].cedula+")' alt='' src='./assets/images/icon-eliminar.png'>"
//                     +"<img onclick='Editar_usuario("+data[obj].cedula+")' alt='' src='./assets/images/icons-lapiz.gif'></td>";
//             k++;
//         }
//     })
//     .catch(error => {
//         console.log("Error: " + error);
//     });
// }
function Actualizar() {
  // Limpiar();
  // verData_usuarios();
  location.reload();
}
function eliminarCliente(cedula) {
  let bandera = window.confirm("¿Esta seguro que desea eliminar?");
  if (bandera) {
    fetch(`../assets/php/admin/Delete_clientes.php?cedula=${cedula}`, {
      //manda cedula a php
      method: "DELETE",
    })
      .then((response) => {
        if (response.ok) {
          alert("Cliente eliminado correctamente");
          Actualizar();
        } else {
          console.error("Eror al eliminar cliente");
        }
      })
      .catch((error) => console.error(error));
  }
}
function Editar_usuario(cedula) {
  
  abrirEditar(); //metodo en el archivo operPege.js
  fetch(`../assets/php/admin/VerEditar.php?cedula=${cedula}`)
    .then((response) => response.json())
    .then((data) => {
      //archivo json
      let cedula = document.getElementById("cedula");
      let nombre = document.getElementById("nombre");
      let apellido = document.getElementById("apellido");
      let fnacimiento = document.getElementById("fnacimiento");
      let direccion = document.getElementById("direccion");
      let email = document.getElementById("email");
      let usuario = document.getElementById("usuario");
      let password = document.getElementById("password");
      let respuesta = document.getElementById("respuesta");
      for (let obj in data) {
        cedula.value = data[obj].cedula;
        nombre.value = data[obj].nombre;
        apellido.value = data[obj].apellido;
        fnacimiento.value = data[obj].fnacimiento;
        direccion.value = data[obj].direccion;
        email.value = data[obj].email;
        usuario.value = data[obj].usuario;
        password.value = data[obj].password;
        respuesta.value = data[obj].respuesta;
      }
    })
    .catch((error) => {
      console.log("Error: " + error);
    });
}
