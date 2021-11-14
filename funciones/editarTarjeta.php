<?php


//CONFIRMA SI LLEGA EL CORREO
if (isset($_POST['correoElectronico'])) {
    
    $datos['IdTarjeta'] = $_POST['IdTarjeta'];
    $datos['correoElectronico'] = $_POST['correoElectronico'];
    $datos['numeroTarjeta'] = $_POST['numeroTarjeta'];
    $datos['NombreDueño'] = $_POST['NombreDueño'];
    $datos['ApellidoDueño'] = $_POST['ApellidoDueño'];
    $datos['vencimiento'] = $_POST['vencimiento'];
    $datos['codigo'] = $_POST['codigo'];

    include_once('../db.php');
    $conexion = abrirConexion();


    //LLAMA A LA FUNCION DE EDITAR LA TARJET
    if (editarTarjeta($conexion,$datos)===true) {
        header("Location: ../index.php");
    }
    
}

?>