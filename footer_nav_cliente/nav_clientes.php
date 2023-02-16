<header class="header" data-header>
    <div class="container">

        <div class="input-wrapper">
            <a href="#"><img src="../../images/logo3.png" class="logo" alt=""></a>
        </div>

        <h2 class="section-title">La Lico Store</h2>

        <div class="header-action">
            <button class="header-action-btn" aria-label="user" onclick="location.href='./editarUsuario.php'">

                <ion-icon name="person-outline" aria-hidden="true"></ion-icon>
            </button>




            <a class="header-action-btn" aria-label="cart" onclick="location.href='./carrito.php'">
                <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                <span id="num_cart" class="btn-badge"></span>
            </a>


            <button class="header-action-btn" aria-label="open menu" data-nav-toggler>
                <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
            </button>

        </div>

    </div>
</header>





<!-- 
    - #SIDEBAR
  -->

<div class="sidebar" data-navbar>

    <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
        <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
    </button>


    <nav class="navbar">
        <ul class="navbar-list">

            <li class="navbar-item">
                <a href="../../../pagina_cliente.php" class="navbar-link" data-nav-link>Inicio</a>
            </li>

            <li class="navbar-item">
                <a href="../../../pagina_cliente.php #product" class="navbar-link" data-nav-link>Productos</a>
            </li>

            <li class="navbar-item">
                <a href="../CerrarSesion.php" class="navbar-link" data-nav-link>Cerrar Sesion</a>
            </li>


        </ul>
    </nav>

    <ul class="contact-list">

        <li>
            <p class="contact-list-title">Contáctanos</p>
        </li>

        <li class="contact-item">
            <address class="address">
                Av.Atahualpa 18-80 y Tobias Mena , Ibarra
            </address>
        </li>

        <li class="contact-item">
            <a href="mailto:support.center@woodex.co" class="contact-link">lalicolicores@hotmail.com</a>
        </li>

        <li class="contact-item">
            <a href="tel:00001235567890" class="contact-link">099 252 9126</a>
        </li>

    </ul>

    <div class="social-wrapper">

        <p class="social-list-title">Síganos en las redes sociales</p>

        <ul class="social-list">

            <li>
                <a href="https://www.facebook.com/lalicolicoresibarra/" class="social-link">
                    <ion-icon name="logo-facebook"></ion-icon>
                </a>
            </li>

            <li>
                <a href="https://mobile.twitter.com/licoreria" class="social-link">
                    <ion-icon name="logo-twitter"></ion-icon>
                </a>
            </li>

            <li>
                <a href="https://www.instagram.com/p/CFupNESpLrZ/" class="social-link">
                    <ion-icon name="logo-instagram"></ion-icon>
                </a>
            </li>

        </ul>

    </div>

</div>

<div class="overlay" data-overlay data-nav-toggler></div>