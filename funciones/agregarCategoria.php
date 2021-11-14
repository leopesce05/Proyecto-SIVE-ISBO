<?php

//Confirma si llego la categoria
if (isset($_POST['nombreCat'])) {
    
    $nombreCat = $_POST['nombreCat'];

    include_once('../db.php');
    $conexion = abrirConexion();

    //SENTENCIA PARA SELECCIONAR LA CATEGORIA
    $sql = "SELECT * FROM categoria WHERE nombreCat = '".$nombreCat."'";

    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        //Si ya existe la categoria lo redirije con mensaje de advertencia
        header('Location:../opcionesAdmin.php?opcion=agregarCategoria&error='.$nombreCat);
    }else{
        //Si no existe la agrega y redirije a CATEGORIAS
        $sql = "INSERT INTO categoria(nombreCat) VALUES ('".$nombreCat."')";

        if ($conexion->query($sql)) {
            header('Location:../opcionesAdmin.php?opcion=categorias');
        }else{
            echo "ERROR AL INGRESAR categoria";
        }
    }

    
    
}

?>