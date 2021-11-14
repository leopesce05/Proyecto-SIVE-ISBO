<?php

include_once('db.php');
$conexion = abrirConexion();
if (isset($_GET['correo'])) {
    $correo=$_GET['correo'];
}else{
    $correo = $_SESSION['correoElectronico'];
}



?>

<!-- Formulairo de agregar tarjeta -->
<form class="formulario" action="funciones/agregarTarjeta.php" method="POST">
    <!-- correo usuairo -->
    <input type="hidden" class="field" name="correoElectronico" 
    value="<?php echo $correo;?>">

<!-- Numero tarjet -->
    <div class="input-Container">
        <label class="inputName" for="numeroTarjeta">Numero de tarjeta</label>
        <input type="text" class="field" placeholder="Numero de tarjeta" id="numeroTarjeta" name="numeroTarjeta" minlength="16" maxlength="16" required onkeypress="return soloNumeros(event)">
    </div>
<!-- Nombre Dueno -->
    <div class="input-Container">
        <label class="inputName" for="nombreDueno">Nombre del propietario</label>
        <input type="text" class="field" placeholder="Nombre del Dueño" id="nombreDueno" name="NombreDueño" required maxlength="16" onkeypress="return soloLetras(event)">
    </div>
<!--  Apellido Dueno -->
    <div class="input-Container">
        <label class="inputName" for="apellidoDueno">Apellido del propietario</label>
        <input type="text" id="apellidoDueno" class="field" placeholder="Apellido del Dueño" name="ApellidoDueño" required maxlength="16" onkeypress="return soloLetras(event)">
    </div>
<!-- Vencimiento -->
    <div class="doble">
        <div class="vencimientoContainer">
            <label class="inputName" for="vencimiento">Fecha vencimiento</label>
            <input type="date" name="vencimiento" id="vencimiento" required min=<?php $hoy=date("Y-m-d"); echo $hoy;?>>
        </div>
<!-- CODIGO DE SEGURIDAD -->
        <div class="vencimientoContainer">
            <label for="pin" class="inputName">PIN</label>
            <input type="number" placeholder="PIN" id="pin" name="codigo" maxlength="3" minlength="3" max="999" min="100" required>
        </div>
        
    </div>
    
    

<!-- BOTON DE ENVIAR -->
    <input class="enviar" type="submit" value="AGREGAR">
</form>