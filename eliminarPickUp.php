<?php
session_start();
if (isset($_GET['confirmar']) && $_SESSION['rol']=="administrador") {
    
    include_once('db.php');
    $conexion = abrirConexion();
    //SENTENCIAS PARA ELIMINAR PICKUP
    $sql = "UPDATE pickupcenter SET estado = '0' WHERE IdPickUp='".$_GET['Id']."'";

    if ($conexion->query($sql)==TRUE) {
        header("Location: opcionesAdmin.php?opcion=pickups");
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
    <title>Eliminar PickUp</title>
</head>
<body>
    <div class="main">
        <div class="confirmar">
            <p class="pregunta">¿Seguro que quiere eliminar este Pick Up?</p>
            <div class="opt">
                <?php
                //CONFIRMACION
                echo "<a class='confirmar-opcion' href='eliminarPickUp.php?Id=".$_GET['Id']."&confirmar=si'>SI</a>";
                echo "<a  class='confirmar-opcion' href='opcionesAdmin.php?opcion=pickups'>NO</a>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>