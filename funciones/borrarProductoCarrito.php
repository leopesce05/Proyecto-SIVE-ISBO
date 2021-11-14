<?php

//CREA LA SESION
session_start();
include_once('../db.php');

$conexion = abrirConexion();
$IdProducto = $_POST['IdProducto'];


//SENTENCIA PARA ELIMINAR EL PRODUCTO DEL CARRITO
$sql = "DELETE FROM carrito WHERE IdProducto='".$IdProducto."' AND correoElectronico='".$_SESSION['correoElectronico']."'"; 
$conexion->query($sql);

?>