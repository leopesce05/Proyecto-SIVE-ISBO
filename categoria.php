<?php

//OBTIENE LOS PRODUCTOS SEGUN LA CATEGORIA
    $IdCat = $_GET['cat'];
    include_once('db.php');
    $conexion = abrirConexion();
    $nombreCat = obtenerCat($conexion,$IdCat);
    $productos = obtenerProductosCategoria($conexion,$IdCat);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include('secciones/importes.php');
    ?>
    <link rel="stylesheet" href="css/mostrarProductos.css">
    <link rel="stylesheet" href="css/header.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nombreCat?></title>
</head>
<body>
    <?php
    include('secciones/header.php');
    ?>
    <div class="main">
        <h1 class="title-productos"><?php echo $nombreCat?></h1>
        <?php

        //MUESTRA LOS PRODUCTOS DE LAS CATEGORIAS
        include('funciones/mostrarProductos.php');
        mostrarProductos($productos);
        if ($productos->num_rows < 1) {
            echo "<h3 class='mensaje-texto' >No hay productos de esta categoria</h3>";
        }
        ?>
    </div>
</body>
</html>