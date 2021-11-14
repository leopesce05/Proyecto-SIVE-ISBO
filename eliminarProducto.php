<?php
session_start();
if (isset($_GET['confirmar'])) {
    
    include_once('db.php');
    $conexion = abrirConexion();
    //SENTENCIAS PARA ELIMNAR PRODUCTO
    $sql = "DELETE FROM carrito WHERE IdProducto='".$_GET['IdProducto']."'";
    $conexion->query($sql);
    $sql = "DELETE FROM historial WHERE IdProducto='".$_GET['IdProducto']."'";
    $conexion->query($sql);

    $sql = "UPDATE producto SET estado = '0' WHERE IdProducto='".$_GET['IdProducto']."'";

    if ($conexion->query($sql)==TRUE) {
        header("Location: index.php");
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
    <title>Eliminar Producto</title>
</head>
<body>
    <div class="main">
        <div class="confirmar">
            <p class="pregunta">¿Seguro que quiere eliminar este Producto?</p>
            <div class="opt">
                <?php
                //PIDE CONFIRMACION
                echo "<a class='confirmar-opcion' href='eliminarProducto.php?IdProducto=".$_GET['IdProducto']."&confirmar=si'>SI</a>";
                echo "<a  class='confirmar-opcion' href='producto.php?IdProducto=".$_GET['IdProducto']."'>NO</a>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>