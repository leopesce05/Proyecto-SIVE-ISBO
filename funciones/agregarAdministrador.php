<?php

 // CONFIRMA SI LLEGO EL CORREO POR POST
if (isset($_POST['correoElectronico'])) {
    
    $correoElectronico = $_POST['correoElectronico'];

    include_once('../db.php');
    $conexion = abrirConexion();

    //CONFIRMA SI YA EXISTE
    $sql = "SELECT * FROM administrador WHERE correoElectronico='".$correoElectronico."'";

    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        //Si ya es administrador lo redirije a la pagina con mensaje de advertencia
        header("Location:../opcionesAdmin.php?opcion=agregarAdministrador&error=existe&correo=".$correoElectronico);
    }else{
        //Si no existe

        //Confirma si existe el usuario
        $sql = "SELECT * FROM usuario WHERE correoElectronico='".$correoElectronico."' AND estado=1";
        
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {

            // Si existe el usuario lo agrega a ADMINISTRADOR
            $sql = "INSERT INTO administrador(correoElectronico) values ('".$correoElectronico."')";
            if ($conexion->query($sql)) {
                header("Location:../opcionesAdmin.php?opcion=administradores");
            }
        
        }else {

            // SINO REDIRIJE CON MENSAJE DE ADVERTENCIA
            header("Location:../opcionesAdmin.php?opcion=agregarAdministrador&error=noexiste&correo=".$correoElectronico);
            
        }
    }

    
    
}

?>