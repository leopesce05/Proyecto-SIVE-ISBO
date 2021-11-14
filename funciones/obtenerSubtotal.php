<?php

//EN FUNCION AL CARRITO, LA CANTIDAD Y EL PRECIO DE CADA PRODUCTO, MUESTRA UN SUBTOTAL DEL PRECIO FINAL
session_start();

$correoElectronico = $_SESSION['correoElectronico'];

include('../db.php');
$conexion = abrirConexion();

$carrito = obtenerProductosCarrito($conexion,$correoElectronico);
$subtotal = 0;
if ($carrito->num_rows > 0) {
    while ($fila = $carrito->fetch_assoc()) {
        $precio = $fila['cantidad']*$fila['precio'];
        $subtotal = $subtotal + $precio;
}
    echo $subtotal;
    
}


?>