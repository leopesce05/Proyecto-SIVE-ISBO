
<?php

include_once('db.php');
$conexion = abrirConexion();

$IdPickUp = $_GET['Id'];
$datos = obtenerPickUp($conexion,$IdPickUp);


?>
<!-- FORMULARIO DE EDITAR PICK UP -->
<form class="formulario" action="funciones/editarPickUp.php" method="POST">

    <input type="hidden" name="IdPickUp"
    value="<?php
    echo $IdPickUp;
    ?>"
    >

    <!-- NOMBRE -->
    <div class="input-container">
        <label class="nombre-input" for="nombre">Nombre del PickUp</label>
        <input class="field" type="text" placeholder="Nombre del PickUp" name="nombre" maxlength="30" required
        value="<?php
        echo $datos['nombre'];
        ?>"
        >
    </div>  
   
    <!-- DIRECCION -->
    <div class="input-container">
        <label class="nombre-input" for="direccion">Direccion</label>
        <input class="field" type="text" placeholder="Direccion" name="direccion" required maxlength="40"
        value="<?php
        echo $datos['direccion'];
        ?>">
    </div>
    
<!-- BOTON DE ENVIAR -->
    <div class="btn-enviar">
        <input type="submit" class="enviar" value="EDITAR">
    </div>
</form>