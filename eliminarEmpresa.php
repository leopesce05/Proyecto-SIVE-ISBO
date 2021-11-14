<?php
session_start();
if (isset($_GET['confirmar']) && $_SESSION['rol']=="administrador") {
    
    include_once('db.php');
    $conexion = abrirConexion();
    //SENTENCIAS PARA ELIMINAR EMPRESA
    $sql="UPDATE producto SET estado=0 WHERE correoElectronico='".$_GET['correo']."'";
    $conexion->query($sql);
    
    
    $sql = "UPDATE empresa SET estado = 0 WHERE correoElectronico='".$_GET['correo']."'";
    if ($conexion->query($sql)==TRUE) {
        header("Location: opcionesAdmin.php?opcion=empresas");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include('./secciones/importes.php');
    ?>
    <link rel="stylesheet" href="css/eliminarEmpresa.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Empresa</title>
</head>
<body>
    <div class="main">
        <div class="confirmar">
            <p class="pregunta">¿Seguro que quiere eliminar esta empresa?</p>
            <div class="opt">
                <?php
                //CONFIRMACION
                echo "<a class='confirmar-opcion' href='eliminarEmpresa.php?correo=".$_GET['correo']."&confirmar=si'>SI</a>";
                echo "<a  class='confirmar-opcion' href='opcionesAdmin.php?opcion=empresas'>NO</a>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>