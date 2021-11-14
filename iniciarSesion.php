<?php
//DEFINIR CONEXION A BASE DE DATOS
include_once('db.php');
$conexion = abrirConexion();

//VALIDA INICIO SESION
if (isset($_POST['correoElectronico'])) {
    $correoElectronico = $_POST['correoElectronico'];
    $contraseña = hash('sha512',$_POST["contraseña"]);

    //Valida inicio sesion y redirecciona
    if (inicioSesion($conexion,$correoElectronico,$contraseña)==FALSE) {
        $inicio = FALSE;
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("secciones/importes.php");
    ?>
    <link rel="stylesheet" href="css/iniciarSesion.css">
    <link rel="stylesheet" href="css/headerLogo.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
</head>
<body>
    <?php
        include('secciones/headerLogo.php');
    ?>

<div class="main">
    <div class="formularios">
        




<!-- FORMULARIO DE INICIO DE SESION -->
<form action="iniciarSesion.php" method="POST" class="formulario">
    <h1 class="title">Iniciar Sesion</h1>    
    <input class="field" type="email" placeholder="Correo Electronico" required maxlength='30' name="correoElectronico"
    value='<?php
    //Si es incorrecto se autocompleta el mail
    if (isset($inicio)) {
        echo $correoElectronico;
    }
    ?>
    '
    >
    <input class="field" type="password" placeholder="Contraseña" name="contraseña" required maxlength="16" minlength="8">

    <?php
    //Mensaje de error de inicio de sesion
    if (isset($inicio)) {
        echo "<p class='red'>Usuario o contraseñas incorrectas</p>";
    }
    ?>

    <div class="btn-enviar">
        <input class="enviar" type="submit" value='INICIAR SESION'>
    </div>
</form>

<div class="register">
    <p class="Goregistrar">¿Todavia no tienes cuenta?<p>
    <a href="registrarse.php" class="btn-registrar">REGISTRATE</a>
</div>

</div>
</div>




</body>
</html>