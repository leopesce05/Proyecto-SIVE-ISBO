<?php

//OBTENER CATEGORIAS
function obtenerCategorias(){
    include_once("db.php");
    $conexion = abrirConexion();
    $sql = " SELECT * FROM categoria";

    $resultado = $conexion->query($sql);

    $categorias = [];
    if ($resultado->num_rows > 0) {
        return $resultado;
    }else{
        return "No hay categorias";
    }

}

?>