<?php

if (isset($_FILES["fotos"])){
    
        //INICIALIZA LOS DATOS
        $datos['nombre'] = $_POST['nombre'];
        $datos['precio'] = $_POST['precio'];
        $datos['descripcion'] = $_POST['descripcion'];
        $datos['uso'] = $_POST['uso'];
        $datos['stock'] = $_POST['stock'];
        $datos['IdCat'] = $_POST['categoria'];

        include_once('../db.php');
        $conexion = abrirConexion();
        session_start();
        //LLAMA A LA FUNCION PARA VENDER
        venderProducto($conexion,$datos,$_FILES,$_SESSION['correoElectronico']);   

}



?>