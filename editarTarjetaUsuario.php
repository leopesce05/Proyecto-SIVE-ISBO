<?php
include_once('db.php');
$conexion = abrirConexion();
$correo = $_SESSION['correoElectronico'];
$datos = datosTarjetaUsuario($conexion,$_GET['Id']);
?>




<form class="formulario" action="funciones/editarTarjeta.php" method="POST">

<input type="hidden" name="correoElectronico" 
value="<?php
echo $correo;
?>
">

<input type="hidden" name="IdTarjeta" 
value="<?php
echo $datos['IdTarjeta'];
?>
">

<!-- Numero tarjeta -->
<div class="input-Container">
    <label class="inputName" for="numeroTarjeta">Numero de tarjeta</label>
    <input type="text" id="numeroTarjeta" class="field" placeholder="Numero de Tarjeta" name="numeroTarjeta" minlength="16" maxlength="16" required onkeypress="return soloNumeros(event)"
    value="<?php
    echo $datos['numeroTarjeta'];
    ?>">
</div>

<!-- Nombre de dueno -->
<div class="input-Container">
    <label class="inputName" for="nombredueno">Nombre del dueño</label>
    <input type="text" class="field" id="nombredueno" placeholder="Nombre del Dueño" name="NombreDueño" required maxlength="16" onkeypress="return soloLetras(event)"
    value="<?php
    echo $datos['NombreDueno'];
    ?>">
</div>

<!-- Apellido de dueno -->
<div class="input-Container">
    <label class="inputName" for="apellidodueno">Apellido del dueño</label>
    <input type="text" class="field" id="apellidodueno" placeholder="Apellido del Dueño" name="ApellidoDueño" required maxlength="16" onkeypress="return soloLetras(event)"
    value="<?php
    echo $datos['ApellidoDueno'];
    ?>">
</div>

<!-- VENCIMIENTO -->
<div class="doble">
        <div class="vencimientoContainer">
            <label class="inputName" for="vencimiento">Fecha vencimiento</label>
            <input type="date" name="vencimiento" id="vencimiento" required min=<?php $hoy=date("Y-m-d"); echo $hoy;?>
            value="<?php
            echo $datos['vencimiento'];
            ?>">
        </div>
<!-- CODIGO SEGURADAD -->
        <div class="vencimientoContainer">
            <label for="pin" class="inputName">PIN</label>
            <input type="number" placeholder="PIN" id="pin" name="codigo" maxlength="3" minlength="3" max="999" min="100" required
            value="<?php
            echo $datos['codigo'];
            ?>">
        </div>
        
    </div>

<input type="submit" class="enviar" value="EDITAR">

</form>