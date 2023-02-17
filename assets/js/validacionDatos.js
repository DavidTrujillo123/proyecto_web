//----------VALIDACIÓN DEL FORMULARIO---------------------------------------------------
//DECLARACIÓN DE VARIABLES
var formulario_login = document.querySelector(".formulario__login");
var formulario_register = document.querySelector(".formulario__register");

var inputs_registro = document.querySelectorAll('#formularior input');
var campos ={
    usernamer: false,
    nombresr: false,
    
    apellidosr: false,
    cedular: false,
    direccionr: false,
    contrasenia: false,
    respuesta:false,
    repeatContrasenia: false,
    correoe: false
}

var expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[A-Z][a-zA-ZÀ-ÿ\s]{3,40}$/, // Letras y espacios, pueden llevar acentos.
	contraseña: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}$/, // 8 caracteres con mayusculas y minusculas
	correo: /^(([^<>()\[\]\.,;:\s@\”]+(\.[^<>()\[\]\.,;:\s@\”]+)*)|(\”.+\”))@(([^<>()[\]\.,;:\s@\”]+\.)+[^<>()[\]\.,;:\s@\”]{2,})$/,
    direccion: /^[A-ZÁÉÍÓÚÑ][A-Za-zÁÉÍÓÚáéíóúñÑ0-9,.\s]{3,16}$/  //letras, números, punto, coma  

}

//FUNCIONES
const validarFormulario = (e) =>{
    switch(e.target.name){
        case "usuario":
            validarCampo(expresiones.usuario, e.target, 'usernamer');
        break;

        case "nombre":
            validarCampo(expresiones.nombre, e.target, 'nombresr');
        break;

        case "apellido":
            validarCampo(expresiones.nombre, e.target, 'apellidosr');
        break;

        case "cedula":
            validarCedula(); //aqui---------------
        break;

        case "email":
            validarCampo(expresiones.correo, e.target, 'correoe');
        break;

        case "direccion":
            validarCampo(expresiones.direccion, e.target, 'direccionr');
        break;

        case "respuesta":
            validarCampo(expresiones.direccion, e.target, 'respuesta');
        break;

        case "password":
            validarCampo(expresiones.contraseña, e.target, 'contrasenia');
            document.getElementById("contrasenia").addEventListener("input", validarPassword2);
        break;
        case "repeatPassword":
            validarPassword2();
        break;
    }
}

const validarPassword2 = () =>{
    const inputPassword1 = document.getElementById("contrasenia");
    const inputPassword2 = document.getElementById("repeatContrasenia");

    if( inputPassword2.value != "" &&(inputPassword1.value === inputPassword2.value)){
        Pintar(true, 'repeatContrasenia');
    } else{
        Pintar(false, 'repeatContrasenia');
        
    }
}

//ValidarCedula--------------------------------
const validarCedula = () => {
    const cedular = document.getElementById("cedular");
    const cedula = cedular.value;

         //Preguntamos si la cedula consta de 10 digitos
        if(cedula.length == 10){
        
            //Obtenemos el digito de la region que son los dos primeros digitos
            var digito_region = cedula.substring(0,2);
            
            //Pregunto si la region existe ecuador se divide en 24 regiones
            if( digito_region >= 1 && digito_region <=24 ){
              
              // Extraigo el ultimo digito
              var ultimo_digito   = cedula.substring(9,10);
    
              //Agrupo todos los pares y los sumo
              var pares = parseInt(cedula.substring(1,2)) + parseInt(cedula.substring(3,4)) + parseInt(cedula.substring(5,6)) + parseInt(cedula.substring(7,8));
    
              //Agrupo los impares, los multiplico por un factor de 2, si la resultante es > que 9 le restamos el 9 a la resultante
              var numero1 = cedula.substring(0,1);
              var numero1 = (numero1 * 2);
              if( numero1 > 9 ){ var numero1 = (numero1 - 9); }
    
              var numero3 = cedula.substring(2,3);
              var numero3 = (numero3 * 2);
              if( numero3 > 9 ){ var numero3 = (numero3 - 9); }
    
              var numero5 = cedula.substring(4,5);
              var numero5 = (numero5 * 2);
              if( numero5 > 9 ){ var numero5 = (numero5 - 9); }
    
              var numero7 = cedula.substring(6,7);
              var numero7 = (numero7 * 2);
              if( numero7 > 9 ){ var numero7 = (numero7 - 9); }
    
              var numero9 = cedula.substring(8,9);
              var numero9 = (numero9 * 2);
              if( numero9 > 9 ){ var numero9 = (numero9 - 9); }
    
              var impares = numero1 + numero3 + numero5 + numero7 + numero9;
    
              //Suma total
              var suma_total = (pares + impares);
    
              //extraemos el primero digito
              var primer_digito_suma = String(suma_total).substring(0,1);
    
              //Obtenemos la decena inmediata
              var decena = (parseInt(primer_digito_suma) + 1)  * 10;
    
              //Obtenemos la resta de la decena inmediata - la suma_total esto nos da el digito validador
              var digito_validador = decena - suma_total;
    
              //Si el digito validador es = a 10 toma el valor de 0
              if(digito_validador == 10)
                var digito_validador = 0;
    
              //Validamos que el digito validador sea igual al de la cedula
              if(digito_validador == ultimo_digito){
                Pintar(true, 'cedular');
                campos.cedular = true;
              }else{
                Pintar(false, 'cedular');
              }
              
            }else{
              //la region no pertenece
              Pintar(false, 'cedular');

            }
         }else{
            //la cedula tiene mas o menos de 10 digitos
            Pintar(false, 'cedular');

         }        
}

//FUNCIÓN QUE PINTA LOS INPUTS 
Pintar =(condicion, id) => {
    if(condicion==true){
        document.getElementById(`${id}`).style.removeProperty('boxShadow');
        document.getElementById(`${id}`).style.boxShadow = "0 0 2.5px 3.5px #009d0a"; //cuando está bien
        campos[id] = true;
    } else{
        document.getElementById(`${id}`).style.removeProperty('boxShadow');
        document.getElementById(`${id}`).style.boxShadow = "0 0 2.5px 3.5px #9d0000"; //cuando está mal
        campos[id] = false;
    }
}

//FUNCIÓN ESENCIAL QUE VALIDA TODO
const validarCampo = (expresion, input, campo) =>{
    if(expresion.test(input.value)){
        Pintar(true, campo);
        if(campos.contrasenia == true) document.getElementById("msjPassword").style.opacity = 0;
    } else{
        Pintar(false, campo);
        if(campos.contrasenia == false) document.getElementById("msjPassword").style.opacity = 90;
    }
}

const calcularEdad = (fechaNacimiento) =>{
    const fechaActual = new Date();
    const anioAcutal = parseInt(fechaActual.getFullYear());
    const mesAcutal = parseInt(fechaActual.getMonth()) +1;
    const diaAcutal = parseInt(fechaActual.getDate());

    //26 - 01 - 2023
    const anioNacimiento = parseInt(String(fechaNacimiento).substring(0, 4));
    const mesNacimiento = parseInt(String(fechaNacimiento).substring(5, 7));
    const diaNacimiento = parseInt(String(fechaNacimiento).substring(8, 10));

    let edad = anioAcutal - anioNacimiento;
    if(mesAcutal < mesNacimiento){
        edad--;
    } else if(mesAcutal === mesNacimiento){
        if(diaAcutal<diaNacimiento){
            edad--;
        }
    }
    return edad;
};


//-----------PARTE DE PREGUNTA DE SEGURIDAD---------------------
function olvidarContrasenia(){
    document.getElementById('IDcontainer').innerHTML = `
    <!--Login-->
    <form action="" class="formulario__login">
        <h2>Pregunta de Seguridad</h2>
        <h4>Correo Electrónico o Nombre de Usuario</h4>
        <input type="text"  name="usuario" id="IDusuarior">
        <h4>¿Cómo se llamó tu primera escuela?</h4>
        <input type="text" name="respuesta"  id="IDpregunta">
        <input type="button" value="Validar" id="btnValidar" onclick="validarPregunta()" >
    </form>
    `;

    let btnRegistrarse = document.getElementById('btn__registrarse');
    btnRegistrarse.innerHTML = 'Volver🔙';
    btnRegistrarse.onclick = () => {
        location.reload();
    }
}
const validarCampoContrasenias = (expresion, input, campo) =>{
    if(expresion.test(input.value)){
        Pintar(true, campo);
        
    } else{
        Pintar(false, campo);
        
    }
}

const validarContraseñas = (e) =>{
    switch(e.target.name){
        case "password":
            validarCampoContrasenias(expresiones.contraseña, e.target, 'contrasenia');
        break;
        case "repeatPassword":
            validarPassword2();
        break;
    }
}
function validarPregunta(){
    let usuario = document.getElementById('IDusuarior').value;
    let respuesta = document.getElementById('IDpregunta').value;
    
    fetch(`./assets/php/ValidarCambioPassword.php?usuario=${usuario}&respuesta=${respuesta}`)
    .then(response => response.json())
    .then(data => {
        if(data){
            nuevaContrasenia(usuario);
            validarNuevasContraseñas();
        }
        else{
            alert("Error ingrese nuevamente");
        }
    })
    .catch(error => {
        console.log("Error: " + error);
    });
    
}

function nuevaContrasenia(usuario){
    document.getElementById('IDcontainer').innerHTML = `

    <form action="./assets/php/ActualizarPassword.php" method="POST" class="formulario__login" id="IDformularioContrasenias">
        <h2>Nueva Contraseña</h2>
        <h4>Ingrese una contraseña</h4>
        <input type="text"  id="nombre" name="usuario" value=`+usuario+` style="display: none;" >
        <input type="password"  name="password" id="contrasenia">
        <h4>Repita la contraseña</h4>
        <input type="password"  id="repeatContrasenia" name="repeatPassword">
        
        <button> Guardar </button>
    </form>
    `;

    let btnRegistrarse = document.getElementById('btn__registrarse');
    btnRegistrarse.onclick = () => {
        location.reload();
    }
}


//---------------------PARTE DE SUBMITS DE LOS FORMULARIOS--------------------
formulario_login.addEventListener('submit', (e) => {
    // e.preventDefault();

});

// function submitContrasenias(){
//     
//     console.log("111");
//     if(form_contrasenias != null){

        
//     }
// }
function vercampos(){
    console.log(campos);
    
}
// var form_contrasenias = document.getElementById('IDformularioContrasenias');
// form_contrasenias.addEventListener('submit', (e) => {
//     console.log("dasdasd");
//     e.preventDefault();
    
    
//     // vercampos();
//     // this.submit();

//     // if(campos.contrasenia && campos.repeatContrasenia){
//     //     ///AQUI MANDE TRUJILLOOOOOOOOOOOOO
//     //     // window.alert("CONTRASEÑAS CAMBIADAS CORRECTAMENTE");
//     //     // form_contrasenias.submit();        
//     // }
//     // else{
//     //     window.alert("Por favor asegurese de escribir correctamente las contraseñas");
//     // }
    
    
// });

formulario_register.addEventListener('submit',(e) =>{
    e.preventDefault();

    const fecha = document.getElementById("fechar");
    const terminos = document.getElementById("TerminosCondiciones");
    if(fecha.value!=null){

        if(calcularEdad(fecha.value)<18){
            window.alert("Página Solo Para Mayores de Edad");
        }
        else if(!terminos.checked){
            window.alert("Por favor, acepte los Términos y Condiciones");
        }
        else{  
            if(campos.usernamer && campos.nombresr && campos.apellidosr && campos.correoe && campos.contrasenia && terminos.checked && campos.cedular && campos.direccionr && campos.repeatContrasenia){
                let usuario = document.getElementById("usernamer").value;
                const ex_regular =  /^A\d+$/;
                console.log(ex_regular.test(usuario));
                if(ex_regular.test(usernamer.value)){
                    let bandera = prompt("Digite el codigo de seguridad proporcionado por su supervisor");
                    if(bandera == "1234"){
                        formulario_register.submit();
                        inputs_registro.forEach((input) =>{
                            input.style.removeProperty("background");
                        });
                        formulario_register.reset();
                    }
                    else{
                        window.alert("Codigo de seguridad incorrecto");
                    }
                }
                else{
                    formulario_register.submit();
                        inputs_registro.forEach((input) =>{
                            input.style.removeProperty("background");
                        });
                        formulario_register.reset();
                }
            }
            else{
                window.alert("Por favor, llene todos los campos correctamente");
            }
        }
    } else{
        window.alert("Por favor, coloque su Fecha de Nacimiento");
    }
    
});

inputs_registro.forEach((input) =>{
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});

function validarNuevasContraseñas(){
    
    var inputs_contrasenias = document.querySelectorAll('#IDformularioContrasenias input');
        inputs_contrasenias.forEach((input) =>{
            input.addEventListener('keyup', validarContraseñas);
            input.addEventListener('blur', validarContraseñas);
    });
    console.log(inputs_contrasenias);
}