<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('secciones/importes.php');?>
    <link rel="stylesheet" href="css/mostrarProductos.css">
    <link rel="stylesheet" href="css/header.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
</head>
<body>
    <?php
    include('secciones/header.php');
    ?>

    <div class="main">
        <h1 class="title-productos">Historial</h1>
        <?php
        //SELECCIONA TODOS LOS PRODUCTOS DEL HISTORIAL Y LOS MUESTRA
        $conexion = abrirConexion();
        $correoElectronico = $_SESSION['correoElectronico'];
        $productos = obtenerProductosHistorial($conexion,$correoElectronico);
        echo $productos->num_rows;
        if ($productos->num_rows>0) {
            include("funciones/mostrarProductos.php");
            mostrarProductos($productos);
        }else{
            echo "<h1>No hay productos en el historial</h1>";
        }
        
        ?>
    </div>
</body>
</html>