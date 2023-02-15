// function Limpiar_inventario(){
//     let tabla_productos = document.getElementById("tabla_productos");
//     let tabla_agotados = document.getElementById("tabla_agotados");
//     tabla_productos.innerHTML = `<tr>
//         <th>Código</th>
//         <th>Nombre producto</th>
//         <th>Descripción</th>
//         <th>Precio</th>
//         <th>Cantidad</th>
//         <th>Imagen</th>
//         <th>Acciones</th>
//     </tr>`;
//     tabla_agotados.innerHTML = `<tr>
//         <th>Código</th>
//         <th>Nombre producto</th>
//         <th>Descripción</th>
//         <th>Precio</th>
//         <th>Cantidad</th>
//         <th>Imagen</th>
//         <th>Acciones</th>
//     </tr>`;
// }
// function verData_inventario(){
//     fetch("../assets/php/admin/Data_productos.php")
//     .then(response => response.json())
//     .then(data => { //archivo json
//         console.log(data);
//         let tabla_stock = document.getElementById("tabla_productos");
//         let tabla_agotados = document.getElementById("tabla_agotados");
//         let img;
//         let k = 0;//utilizada para darle ids unicos
//         let id_img;
//         for(let obj in data){
//             //crea una etiqueta de una imagen <img width="100" height="100" src="imagen.jpg">
//             img = new Image(100,100);
//             codigo_producto = JSON.stringify(data[obj].codigo_producto);//para que no se referencie como objeto
//             if(data[obj].cantidad > 0){
//                 tabla_stock.innerHTML += '<td id="codigo_producto'+k+'">'+data[obj].codigo_producto+'</td>'
//                 +'<td id="nombre_producto'+k+'">'+data[obj].nombre_producto+'</td>'
//                 +'<td id="descripcion'+k+'">'+data[obj].descripcion+'</td>'
//                 +'<td id="precio'+k+'">'+data[obj].precio+'</td>'
//                 +'<td id="cantidad'+k+'">'+data[obj].cantidad+'</td>'
//                 +'<td id="img'+k+'"> </td>'
//                 +"<td> <img onclick='eliminarProducto("+codigo_producto+")' alt='' src='./assets/images/icon-eliminar.png'>"
//                     +"<img onclick='Editar_producto("+codigo_producto+")' alt='' src='./assets/images/icons-lapiz.gif'></td>";

//             }else{
//                 tabla_agotados.innerHTML += '<td id="codigo_producto'+k+'">'+data[obj].codigo_producto+'</td>'
//                 +'<td id="nombre_producto'+k+'">'+data[obj].nombre_producto+'</td>'
//                 +'<td id="descripcion'+k+'">'+data[obj].descripcion+'</td>'
//                 +'<td id="precio'+k+'">'+data[obj].precio+'</td>'
//                 +'<td id="cantidad'+k+'">'+data[obj].cantidad+'</td>'
//                 +'<td id="img'+k+'"> </td>'
//                 +"<td> <img onclick='eliminarProducto("+codigo_producto+")' alt='' src='./assets/images/icon-eliminar.png'>"
//                     +"<img onclick='Editar_producto("+codigo_producto+")' alt='' src='./assets/images/icons-lapiz.gif'></td>";

//             }
//             //mostrar las imagenes
//             img.src = "data:image/png;base64,"+data[obj].img;//decodifica la imagen en base64
//             id_img = document.getElementById("img"+k);
//             id_img.appendChild(img);
//             k++;

//         }
//     })
//     .catch(error => {
//         console.log("Error: " + error);
//     });
// }
function Actualizar_inventario() {
  location.reload();
}
function eliminarProducto(codigo_producto) {
  let bandera = window.confirm("¿Esta seguro que desea eliminar?");
  if (bandera) {
    fetch(
      `../assets/php/admin/Delete_productos.php?codigo_producto=${codigo_producto}`,
      {
        //manda codigo a php
        method: "DELETE",
      }
    )
      .then((response) => {
        if (response.ok) {
          alert("Producto eliminado correctamente");
          Actualizar_inventario();
        } else {
          console.error("Failed to delete data");
        }
      })
      .catch((error) => console.error(error));
  }
}
function Editar_producto(codigo_producto) {
  abrirEditar_producto();
  fetch(
    `../assets/php/admin/VerEditar_producto.php?codigo_producto=${codigo_producto}`
  )
    .then((response) => response.json())
    .then((data) => {
      //archivo json
      let codigo_producto = document.getElementById("codigo_producto");
      let nombre_producto = document.getElementById("nombre_producto");
      let descripcion = document.getElementById("descripcion");
      let precio = document.getElementById("precio");
      let cantidad = document.getElementById("cantidad");
      for (let obj in data) {
        codigo_producto.value = data[obj].codigo_producto;
        nombre_producto.value = data[obj].nombre_producto;
        descripcion.value = data[obj].descripcion;
        precio.value = data[obj].precio;
        cantidad.value = data[obj].cantidad;
      }
    })
    .catch((error) => {
      console.log("Error: " + error);
    });
}
