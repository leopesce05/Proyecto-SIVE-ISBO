<?php


// Confirma si llegaron los datos
if (isset($_POST['direccion'])) {


    //Inicializa datos
    $datos['direccion'] = $_POST['direccion'];
    $datos['nombre'] = $_POST['nombre'];
    $datos['IdPickUp'] = $_POST['IdPickUp'];


    include_once('../db.php');
    $conexion = abrirConexion();

    //Actualiza el pickupCenter
    $sql = "UPDATE pickupcenter SET nombre='".$datos['nombre']."', direccion='".$datos['direccion']."' WHERE IdPickUp=".$datos['IdPickUp'];

    //Si se actualiza, Redirije
    if ($conexion->query($sql)) {
        header('Location:../opcionesAdmin.php?opcion=pickups');
    }else{
        echo "ERROR AL EDITAR PickUp";
    }
    
}

?>