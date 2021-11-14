<?php

//Confirma si existe la direccion
if (isset($_POST['direccion'])) {
    
    $datos['direccion'] = $_POST['direccion'];
    $datos['nombre'] = $_POST['nombre'];

    include_once('../db.php');
    $conexion = abrirConexion();


    //Agrega el pickUp a la base de datos
    $sql = "INSERT INTO pickupcenter(nombre,direccion) VALUES ('".$datos['nombre']."','".$datos['direccion']."')";

    if ($conexion->query($sql)) {
        //Si se agrega con exito redirije a PickUps
        header('Location:../opcionesAdmin.php?opcion=pickups');
    }else{
        //Si no se pudo agregar, muestra mensaje de error
        echo "ERROR AL INGRESAR PickUp";
    }
    
}

?>