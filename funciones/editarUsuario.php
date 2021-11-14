<?php

include_once("../db.php");
$conexion = abrirConexion();
session_start();

//CONFIRMA SI LLEGA EL CORREo
if (isset($_POST['correoElectronico'])) {

    $correoElectronico = $_POST['correoElectronico'];
    //INICIALIZA DATOS
    $datos['nombre'] = $_POST['nombre'];
    $datos['apellido'] = $_POST['apellido'];
    $datos['direccion'] = $_POST['direccion'];
    $datos['celular'] = $_POST['celular'];

    //VERIFICA LE ROL DE LA SESION y EDITA AL USUARIO
    if ($_SESSION['rol'] =='administrador' && $correoElectronico != $_SESSION['correoElectronico'] ) {
        $datos['lugar'] = "admin";
    }else{
        $datos['lugar'] = "user";
    }

    //LLAMA A LA FUNCION PARA EDITARLO
    editarUsuario($conexion,$datos,$correoElectronico);
}

?>