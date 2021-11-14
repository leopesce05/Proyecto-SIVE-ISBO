<?php
include_once('../db.php');
$conexion = abrirConexion();

//Si llegan los datos
if (isset($_POST['correoElectronico'])) {

    //INICiALIZA DATOS
    $datos['correoElectronico'] = $_POST['correoElectronico'];
    $datos['nombreEmpresa'] = $_POST['nombreEmpresa'];
    $datos['RUT'] = $_POST['RUT'];

    //LLAMA A LA FUNCION DE CAMBIAR DATOS EMPRESA
    $cambio = editarDatosEmpresa($conexion,$datos);


    //Si todo se cambio redijirje, de lo contrario muestra mensaje de error
    if ($cambio===true) {
        header("Location: ../index.php");
    }else {
        echo "ERROR AL MODIFICAR DATOS";
    }
}
?>