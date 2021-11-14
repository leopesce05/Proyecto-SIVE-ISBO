<?php

//Confirma si llego el correoElectronico
if (isset($_POST['numeroTarjeta'])) {
    
    //INICIALIZA LOS DATOS
    session_start();
    $datos['correoElectronico'] = $_SESSION['correoElectronico'];
    $datos['numeroTarjeta'] = $_POST['numeroTarjeta'];
    $datos['NombreDueño'] = $_POST['NombreDueño'];
    $datos['ApellidoDueño'] = $_POST['ApellidoDueño'];
    $datos['vencimiento'] = $_POST['vencimiento'];
    $datos['codigo'] = $_POST['codigo'];

    include_once('../db.php');
    $conexion = abrirConexion();

    //Llama a la funcion para agregar la tarjeta  y envia los datos
    if (agregarTarjeta($conexion,$datos)===true) {
        header("Location: ../index.php");
    }
    
}

?>