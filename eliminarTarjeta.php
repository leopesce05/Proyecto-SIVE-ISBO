<?php
session_start();
if (isset($_GET['confirmar'])) {
    
    include_once('db.php');
    $conexion = abrirConexion();
    //SENTENCIAS PARA ELMINAR TARJETA
    $sql = "UPDATE tarjeta SET estado = '0' WHERE IdTarjeta='".$_GET['IdTarjeta']."'";

    if ($conexion->query($sql)==TRUE) {
       header("Location: datosUsuario.php?opcion=tarjetaUsuario");
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
    <title>Eliminar Tarjeta</title>
</head>
<body>
    <div class="main">
        <div class="confirmar">
            <p class="pregunta">¿Seguro que quiere eliminar esta Tarjeta?</p>
            <div class="opt">
                <?php
                //CONFIRMACION PARA ELIMINAR TARJETA
                echo "<a class='confirmar-opcion' href='eliminarTarjeta.php?IdTarjeta=".$_GET['IdTarjeta']."&confirmar=si'>SI</a>";
                echo "<a  class='confirmar-opcion' href='datosUsuario.php?opcion=tarjetaUsuario'>NO</a>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>