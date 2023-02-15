<?php
include_once "funcion.php";
if (!isset($_POST["id"])) {
    exit("No hay id_producto");
}
quitarProductoDelCarrito($_POST["id"]);
# Saber si redireccionamos a tienda o al carrito, esto es porque
# llamamos a este archivo desde la tienda y desde el carrito
if (isset($_POST["redireccionar_carrito"])) {
    header("Location: ../classes/carrito.php");
} else {
    header("Location: ../index.php");

}
?>
