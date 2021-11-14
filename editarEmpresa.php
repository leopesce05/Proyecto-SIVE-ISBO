
<?php
include_once('db.php');
$conexion = abrirConexion();
if (isset($_SESSION['correoElectronico']) && $_SESSION['rol'] == 'empresa') {
    $correo = $_SESSION['correoElectronico'];
}else {
    $correo = $_GET['correo'];
}


$datos = obtenerDatosEmpresa($conexion,$correo);

?>
<!-- FORMULARIO DE EDICION DE EMPRESA -->
<form class="formulario" action="funciones/editarEmpresa.php" method="POST">

    <input type="hidden" name="correoElectronico" 
    value="<?php
    echo $correo;
    ?>
    ">

    <!-- NOMBRE -->
    <div class="inputContainer">
        <label for="nombreEmpresa">Nombre: </label>
        <input type="text" class="field" id="nombreEmpresa" placeholder="Nombre" maxlength="16" name="nombreEmpresa" minlength="8" require
        value="<?php
        echo $datos['nombreEmpresa'];
        ?>"
        >
    </div>

    <!-- RUT -->
    <div class="inputContainer">
        <label for="nombreEmpresa">RUT: </label>
        <input class="field" type="text" placeholder="RUT" id="RUT" name="RUT" onkeypress="return soloNumeros(event)" required maxlength="12" minlength="12"
        value="<?php
        echo $datos['RUT'];
        ?>"
        >
    </div>

    <!-- BOTON ENVIAR -->
    <input class="enviar" type="submit" value="GUARDAR">
</form>