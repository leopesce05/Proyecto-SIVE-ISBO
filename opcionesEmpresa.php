<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("secciones/importes.php");
    if (!isset($_GET['opcion']) || $_GET['opcion'] == 'vender') {
                
        echo "<link rel='stylesheet' href='css/venderProducto.css'>";

    }elseif ($_GET['opcion']== 'productos') {

        echo "<link rel='stylesheet' href='css/mostrarProductos.css'>";
        
    }elseif ($_GET['opcion']== 'ventas') {

        
        echo "<link rel='stylesheet' href='css/mostrarVentas.css'>";
    }

    ?>
    
    <link rel="stylesheet" href="css/opcionesEmpresa.css">
    <link rel="stylesheet" href="css/header.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opciones Empresa</title>
</head>
<body>
    <?php
    include('secciones/header.php');
    ?>

    <div class="main">

        <?php
        include_once("db.php");
        $conexion = abrirConexion();
        if (confirmarTarjetaEmpresa($conexion,$_SESSION['correoElectronico']) == true) {
        
        ?>
        <input type="checkbox" id="check-opciones" class="check-opciones">
        <label class="tab-option" for="check-opciones"><i class="fas fa-bars"></i></label>
        <!-- OPCIONES A SELECCIONAR -->
        <div class="opciones">
            <div class="linkContainer"><a class="linkOP" href="opcionesEmpresa.php?opcion=vender">VENDER</a></div>
            <div class="linkContainer"><a class="linkOP" href="opcionesEmpresa.php?opcion=productos">PRODUCTOS</a></div>
            <div class="linkContainer"><a class="linkOP" href="opcionesEmpresa.php?opcion=ventas">VENTAS</a></div>
        </div>
        
        
        <div class="opcion">
            <?php
            if (!isset($_GET['opcion']) || $_GET['opcion'] == 'vender') {
                
                include('venderProducto.php');

            }elseif ($_GET['opcion']== 'productos') {

                include('funciones/obtenerProductosEmpresa.php');
                $productos = obtenerProductosEmpresa();
                include('funciones/mostrarProductos.php');
                mostrarProductos($productos);
                
            }elseif ($_GET['opcion']== 'ventas') {

                include('funciones/mostrarVentas.php');
                
            }
            ?>
        </div>

        <?php
        }else{
        ?>

        <p class="mensajeError">No tiene tarjeta asociada, porfavor ingrese a opciones de cuenta e ingrese una</p>
        
        <?php
        }
        ?>
    </div>
       <script src="js/soloNumeros.js"></script>
       <script src="js/soloLetras.js"></script>
</body>
</html>