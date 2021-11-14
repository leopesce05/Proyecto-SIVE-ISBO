<?php

//CONFIRMA SI LLEGO EL NOMBRE
if (isset($_POST['nombreCat'])) {
    
    //INICIALIZA LOS DATOS
    $nombreCat = $_POST['nombreCat'];
    $IdCat = $_POST['IdCat'];

    include_once('../db.php');
    $conexion = abrirConexion();

    //CAMBIA LOS DATOS
    $sql= "UPDATE categoria SET nombreCat = '".$nombreCat."' WHERE IdCat=".$IdCat;

    //Si se cambio con exito redirije
    if ($conexion->query($sql)) {
        header('Location:../opcionesAdmin.php?opcion=categorias');
    }

    
    
}

?>