<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar e Iniciar Sesión "La Lico"</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <!--Iconos-->
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
</head>
<body>

        <main>

            <div class="contenedor__todo">
                <div class="caja__trasera">
                    <div class="caja__trasera-login">
                        <h3>¿Ya tienes una cuenta?</h3>
                        <p>Inicia sesión para entrar en la página</p>
                        <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                    </div>
                    <div class="caja__trasera-register">
                        <h3>¿Aún no tienes una cuenta?</h3>
                        <p>Regístrate para que puedas iniciar sesión</p>
                        <button id="btn__registrarse">Registrarse</button>
                    </div>
                </div>

                <!--Formulario de Login y registro-->
                <div class="contenedor__login-register" id="IDcontainer">
                    <!--Login-->
                    <form action="./assets/php/usuarios/Select_login.php" method="POST" class="formulario__login">
                        <h2>Iniciar Sesión</h2>
                        <h4>Usuario</h4>
                        <input type="text" placeholder="Correo Electrónico o Nombre de Usuario" name="usuario">
                        <h4>Contraseña</h4>
                        <input type="password" placeholder="Contraseña" id="contraseniai" name="password">
                        <a href="#" onclick="olvidarContrasenia()"> ¿Olvidó su contraseña?</a><br>
                        <!-- <input type="submit" value="Entrar"> -->
                        <button type="submit">Entrar</button>
                    </form>

                    <!--Register-->
                    <form action="./assets/php/usuarios/Insert_usuarios.php" method="POST" class="formulario__register" id="formularior">
                        <h2>Registrarse</h2>
                        <h4>Nombres:</h4>
                        <input type="text" placeholder="Nombres" name="nombre" id ="nombresr" required title="Deivi">
                        <h4>Apellidos:</h4>
                        <input type="text" placeholder="Apellidos" name="apellido" id="apellidosr" required>
                        <h4>Cédula:</h4>
                        <input type="text" placeholder="Cédula" name="cedula" id="cedular" required>
                        <h4>Nombre de usuario:</h4>
                        <input type="text" placeholder="Nombre de Usuario" name="usuario" id="usernamer" required>
                        <h4>Correo Electrónico:</h4>
                        <input type="text" placeholder="Correo Electrónico" name="email" id="correoe" required>
                        <h4>Ciudad:</h4> <br>
                        <select name="ciudad" id="IDdireccion">
                            <option>Ambato</opction><option>Cuenca</opction><option>Esmeraldas</opction>
                            <option>Ibarra</opction><option>Quito</opction><option>Santo Domingo</opction>
                            <option>Latacunga</opction><option>Tulcan</opction><option>Quevedo</opction>
                            <option>Puyo</opction><option>Tena</option><option>Loja</option>
                            <option>Machala</option><option>Guayaquil</option><option>Durán</option>
                            <option>Babahoyo</option><option>Guaranda</option>
                        </select>
                        <h4>Dirección:</h4>
                        <input type="text" placeholder="Dirección" name="direccion" id="direccionr" required>

                        <h4>Fecha de Nacimiento:</h4>
                        <input type="date" placeholder="Fecha de Nacimiento" name="fnacimiento" id="fechar" min="1930-01-01" max="2023-12-31" required>
                        <h4>Contraseña:</h4>
                        <input type="password" placeholder="Contraseña" name="password" id="contrasenia" required>
                        <!--<img src="./assets/images/eye.png" alt="Eye" class="icon" id="eyei">-->
                        <h5 id="msjPassword">La contraseña debe tener mayúsculas, minúsculas y números, con más de 8 caractéres</h5>
                        <h4>Repetir contraseña:</h4>
                        <input type="password" placeholder=" Repetir Contraseña" name="repeatPassword" id="repeatContrasenia" required>
                        <!--<img src="./assets/images/eye.png" alt="Eye" class="icon" id="eyei">-->
                        <h4>Pregunta de seguridad: ¿Cómo se llamó tu primera escuela?</h4>
                        <input type="text" placeholder="Respuesta" name="respuesta" id="respuesta" required>
                        <input type="checkbox" name="terminos" id="TerminosCondiciones" required>  <label for="TerminosCondiciones">Aceptar Términos y Condiciones</label> 
                        <button>Registrarse</button>
                    </form>
                </div>
            </div>

        </main>

        <!--Footer-->
        <footer id="foot">
            <div class="grupo-1">
                <div class="box">
                    <figure>
                        <a href="#">
                            <img src="./assets/images/logo2.png" alt="Logo de La Lico">
                        </a>
                    </figure>
                </div>
                <div class="box" id="sobreNostros">
                    <h2>SOBRE NOSOTROS</h2>
                    <p>La Lico es una licorería dedicado a brindar a sus clientes una amplia variedad de bebidas alcohólicas de alta calidad a precios competitivos.</p>
                    
                </div>
                <div class="box">
                    <h2>SÍGUENOS</h2>
                    <div class="red-social">
                        <a href="https://www.facebook.com/lalicolicoresibarra" class="fa fa-facebook" target="_blank"></a>
                        <a href="https://www.instagram.com/lalicocruzverde/" class="fa fa-instagram" target="_blank"></a>
                        <a href="https://wa.me/593961971500" class="fa fa-whatsapp" target="_blank"></a>
                    </div>
                </div>
            </div>
            <div class="grupo-2">
                <small> &copy; 2023 <b>La Lico</b> - Todos los Derechos Reservados</small>
            </div>
        </footer>
        <script src="assets/js/script.js"></script>
        <script src="./assets/js/validacionDatos.js"></script>
</body>
</html>