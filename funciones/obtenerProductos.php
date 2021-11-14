<?php

function obtenerProductos(){

    include_once('db.php');
    $conexion = abrirConexion();

    //SELECCIONA TODOS LOS PRODUCTOS QUE ESTAN ACTIVOS
    $sql= "SELECT * FROM producto WHERE estado = 1";
    $resultado = $conexion->query($sql);

    //SI NO EXISTEN MUESTRA UN MENSAJE
    if ($resultado->num_rows > 0) {
        return $resultado;
    }else{
        echo "<h1>No hay productos registrados</h1>";
    }
}
?>