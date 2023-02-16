//----------VALIDACIÓN DEL FORMULARIO---------------------------------------------------
//DECLARACIÓN DE VARIABLES
var formulario = document.querySelector("#IDform");

var inputs_form = document.querySelectorAll('#IDform input');

var campos ={
    IDnombre: false,
    IDapellido: false,

    IDdireccion: false,
    IDrespuesta: false,
    IDpassword: false,
    IDrepeatPassword: false,

}

var expresiones = {
	
	nombre: /^[a-zA-ZÀ-ÿ\s]{3,40}$/, // Letras y espacios, pueden llevar acentos.
	contraseña: /^[a-zñA-ZÑ0-9]{8,12}$/, // 8 a 12 caracteres con mayusculas y minusculas
	correo: /^(([^<>()\[\]\.,;:\s@\”]+(\.[^<>()\[\]\.,;:\s@\”]+)*)|(\”.+\”))@(([^<>()[\]\.,;:\s@\”]+\.)+[^<>()[\]\.,;:\s@\”]{2,})$/,
    direccion: /^[A-ZÁÉÍÓÚÑ][A-Za-zÁÉÍÓÚáéíóúñÑ0-9,.\s]{3,16}$/ //letras, números, punto y comas

}

//FUNCIONES
const validarFormulario = (e) =>{
    switch(e.target.name){

        case "nombre":
            validarCampo(expresiones.nombre, e.target, 'IDnombre');
        break;

        case "apellido":
            validarCampo(expresiones.nombre, e.target, 'IDapellido');
        break;

        case "direccion":
            validarCampo(expresiones.direccion, e.target, 'IDdireccion');
        break;

        case "respuesta":
            validarCampo(expresiones.direccion, e.target, 'IDrespuesta');
        break;

        case "password":
            validarCampo(expresiones.contraseña, e.target, 'IDpassword');               
        break;

        case "repeatPassword":
            validarPassword2();
        break;
    }
}

const validarPassword2 = () =>{
    const inputPassword1 = document.getElementById("IDpassword");
    const inputPassword2 = document.getElementById("IDrepeatPassword");

    if(inputPassword1.value !== inputPassword2.value){
        Pintar(false, 'IDrepeatPassword');
    } else{
        Pintar(true, 'IDrepeatPassword');
        
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
    console.log(input, campo);
    if(expresion.test(input.value)){
        Pintar(true, campo);
    } else{
        Pintar(false, campo);     
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



formulario.addEventListener('submit',(e) =>{
    e.preventDefault();

    const fecha = document.getElementById("IDfnacimiento");

    if(fecha.value!=null){

        if(calcularEdad(fecha.value)<18){
            window.alert("Página Solo Para Mayores de Edad");
        }
        else{  

            if(campos.IDnombre && campos.IDapellido && campos.IDrespuesta && campos.IDpassword && campos.IDdireccion && campos.IDrepeatPassword){
                
                formulario.submit();
                inputs_form.forEach((input) =>{
                    input.style.removeProperty("boxShadow");
                });
                formulario.reset();
                
            }
            else{
                window.alert("Por favor, llene todos los campos correctamente");
            }
        }
    } else{
        window.alert("Por favor, coloque su Fecha de Nacimiento");
    }
    
});

inputs_form.forEach((input) =>{
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
    input.addEventListener('mouseover',validarFormulario);
});