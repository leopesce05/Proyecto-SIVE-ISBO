<?php
session_start();
if (isset($_GET['confirmar']) && $_SESSION['rol']=="administrador") {
    
    include_once('db.php');
    $conexion = abrirConexion();
        //SENTENCIAS PARA ELIMINAR ADMINISTRADOR
        $sql = "DELETE FROM administrador WHERE correoElectronico='".$_GET['correo']."'";

        
        if ($conexion->query($sql)==TRUE) {
            header("Location: opcionesAdmin.php?opcion=administradores");
        }else{
            echo "ERROR ADMIN";
        }
    
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include('./secciones/importes.php');
    ?>
    <link rel="stylesheet" href="css/eliminarPickUp.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Administrador</title>
</head>
<body>
    <div class="main">
        <div class="confirmar">
            <p class="pregunta">¿Seguro que quiere eliminar este Administrador?</p>
            <div class="opt">
                <?php
                //CONFIRMACION PARA ELIMINAR
                echo "<a class='confirmar-opcion' href='eliminarAdministrador.php?correo=".$_GET['correo']."&confirmar=si'>SI</a>";
                echo "<a  class='confirmar-opcion' href='opcionesAdmin.php?opcion=administradores'>NO</a>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>