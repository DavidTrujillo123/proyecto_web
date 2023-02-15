//--------------PRODUCTOS---------------------------//
let formularioAgregarActualizar = `
        <div class="inicio_input">    
            <label for="nombre_producto">Nombre producto:</label>
            <input type="text" name="nombre_producto" id="nombre_producto" value="" required><br>
        </div>
        <div class="inicio_input">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" value="" cols="40" rows="5" required ></textarea><br>
        </div>
        <div class="inicio_input">
            <label for="precio">Precio:</label>
            <input type="number" min="0" step=".01" name="precio" id="precio" value="" style="width : 150px;" required><br>
        </div>
        <div class="inicio_input">
            <label for="cantidad">Cantidad:</label>
            <input type="number" min="0" name="cantidad" id="cantidad" value="" style="width : 150px;" required><br>
        </div>
`;
function abrirAgregar(){
    // window.location("./admin.php");
    let tag = document.getElementById("principal");
    tag.innerHTML = `
    <div id="id_agregarProducto">
        <h1>Agregar Producto Nuevo</h1>
        <form action="../assets/php/admin/Insert_productos.php" method="POST" enctype="multipart/form-data">
            <div class="inicio_input">
                <label for="codigo_producto">Código:</label>
                <input type="text" name="codigo_producto" id="codigo_producto" value="" required><br>
            </div>
            `+formularioAgregarActualizar+` 
            <div class="inicio_input">
                <label for="img">Imagen</label>
                <input type="file" name="img" id="img" accept="image/png, image/jpg, image/jpeg" multiple required=""><br>
            </div>   
            <input type="submit" value="Actualizar" id="submit">
        </form>
    </div>
    `;
    //linea 25 -> uso de enctype="multipart/form-data
    //linea 33 -> uso de multiple
    //Ambas no ayudan a permitir la carga de archivos a la base de datos
}
function abrirEditar_producto(){ 
    let tag = document.getElementById("tablas");
    tag.innerHTML = `
        <h1>Actualizar Producto</h1>
        <form action="../assets/php/admin/Update_productos.php" method="POST" enctype="multipart/form-data">
            <div class="inicio_input">
                <label for="codigo_producto">Código:</label>
                <input type="text" name="codigo_producto" id="codigo_producto" value="" readonly><br>
            </div>
            `+formularioAgregarActualizar+`
            <div class="inicio_input">
                <label for="img">Imagen</label>
                <input type="file" name="img" id="img" accept="image/png, image/jpg, image/jpeg" multiple><br>
            </div>
            <button>Guardar</button>
        </form>`;
}

//--------------USUARIOS---------------------------//
function abrirEditar(){
    let tag = document.getElementById("tablas");
    tag.innerHTML = `
    <form action="../assets/php/admin/Update_clientes.php" method="POST">
        <div class="inicio_input">
            <label for="cedula">Cedula:</label>
            <input type="text" name="cedula" id="cedula" value="" readonly><br>
        </div>
        <div class="inicio_input">    
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="" required><br>
        </div>
        <div class="inicio_input">
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido" value="" required><br>
        </div>
        <div class="inicio_input">
            <label for="fnacimiento">Fecha de nacimiento</label>
            <input type="date" name="fnacimiento" id="fnacimiento" value="" required><br>
        </div>
        <div class="inicio_input">
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion" value="" required><br>
        </div>
        <div class="inicio_input">
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" value="" required><br>
        </div>
        <div class="inicio_input">
            <label for="usuario">Nombre de usuario:</label>
            <input type="text" name="usuario" id="usuario" value="" required><br>
        </div>
        <div class="inicio_input">
            <label for="password">Contraseña:</label>
            <input type="text" name="password" id="password" value="" required><br>
        </div>
        <div class="inicio_input">
            <label for="respuesta">Respuesta:</label>
            <input type="text" name="respuesta" id="respuesta" value="" required><br>
        </div>
        <button>Guardar</button>
    </form>`;
}
