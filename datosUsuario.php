
<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php
    include('secciones/importes.php');
    ?>
    
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/datosUsuario.css">

<!-- OBTIENE LA OPCION Y DEFINE LOS ESTILOS NECESARIOS -->
    <?php
    if (isset($_GET['opcion'])) {
        if ($_GET['opcion']=='agregarTarjetaUsuario') {
            echo "<link rel='stylesheet' href='css/agregarTarjeta.css'>";
        }elseif ($_GET['opcion']=='tarjetaUsuario') {
            echo "<link rel='stylesheet' href='css/opcionesAdmin.css'>";
        }elseif ($_GET['opcion']=='editarUsuario') {
            echo "<link rel='stylesheet' href='css/editarUsuario.css'>";
        }elseif ($_GET['opcion']=='editarTarjeta' || $_GET['opcion']=='tarjetaEmpresa') {
            echo "<link rel='stylesheet' href='css/editarTarjeta.css'>";
        }elseif ($_GET['opcion']=='editarEmpresa') {
            echo "<link rel='stylesheet' href='css/editarEmpresa.css'>";
        }elseif ($_GET['opcion']=='compras') {
            echo "<link rel='stylesheet' href='css/mostrarCompras.css'>";
        }
  
    }else{
        session_start();
        echo "<!--".$_SESSION['rol']."-->";
        if ($_SESSION['rol']=='empresa') {
            echo "<link rel='stylesheet' href='css/editarEmpresa.css'>";
        }else{
            echo "<!--HOLA-->";
            echo "<link rel='stylesheet' href='css/editarUsuario.css'>";
        }
    }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Usuario</title>
</head>
<body>
    <?php
    include('secciones/header.php');
    ?>


<div class="main">
    <?php
    //PARA LAS EMPRESAS
    if ($_SESSION['rol']=='empresa') {
    ?>
        <input type="checkbox" id="check-opciones" class="check-opciones">
        <label class="tab-option" for="check-opciones"><i class="fas fa-bars"></i></label>
        
        <!-- PUEDE SELECCIONAR LAS DIFERENTES OPCIONES DE LAS EMPRESAS -->
        <div class="opciones">
            <div class="linkContainer"><a class="linkOP" href="datosUsuario.php?opcion=editarEmpresa">Datos de Cuenta</a></div>
            <div class="linkContainer"><a class="linkOP" href="datosUsuario.php?opcion=tarjetaEmpresa">TARJETA</a></div>
            <div class="linkContainer"><a class="linkOP" href="funciones/cerrarSesion.php">CERRAR SESION</a></div>
        </div>

       <!-- Aqui se carga la opcion segun la seleccion -->
        <div class="opcion">
            <?php
            if (!isset($_GET['opcion']) || $_GET['opcion'] == 'editarEmpresa') {
                //POR DEFECTO MUESTRA LA DE EDITIAR LA EMPRESA
                include('editarEmpresa.php');

            }else {
                if ($_GET['opcion']== 'tarjetaEmpresa') {
                    include('editarTarjetaEmpresa.php');
                }
            }
            ?>
        </div>
    <?php

    //PARA LOS USUARIOS
    }else{
    ?>
<input type="checkbox" id="check-opciones" class="check-opciones">
        <label class="tab-option" for="check-opciones"><i class="fas fa-bars"></i></label>
        
        <!-- Muestra las diferentes opciones de un usuario -->
        <div class="opciones">
            <div class="linkContainer"><a class="linkOP" href="datosUsuario.php?opcion=editarUsuario">Datos de Cuenta</a></div>
            <div class="linkContainer"><a class="linkOP" href="datosUsuario.php?opcion=tarjetaUsuario">TARJETA</a></div>
            <div class="linkContainer"><a class="linkOP" href="datosUsuario.php?opcion=compras">COMPRAS</a></div>
            <div class="linkContainer"><a class="linkOP" href="funciones/cerrarSesion.php">CERRAR SESION</a></div>
        </div>

        <!-- Aqui se carga la opcion -->
        <div class="opcion">
            <?php
            if (!isset($_GET['opcion']) || $_GET['opcion'] == 'editarUsuario') {
                
                include('editarUsuario.php');


            }elseif ($_GET['opcion'] == 'tarjetaUsuario') {
                include('funciones/mostrarTarjetas.php');
                mostrarTarjetas();
            }elseif ($_GET['opcion'] == 'agregarTarjetaUsuario') {

                include('agregarTarjeta.php');
            
            }elseif ($_GET['opcion'] == 'editarTarjeta') {

                include('editarTarjetaUsuario.php');
            
            }elseif ($_GET['opcion'] == 'compras') {

                include('funciones/mostrarCompras.php');
            
            }
            ?>
        </div>


    <?php
    }
    ?>

</div>

<!-- SCRIPTS PARA VALIDACION DE FORMULARIOS -->
<script src="js/soloNumeros.js"></script>
<script src="js/soloLetras.js"></script>
</body>
</html>