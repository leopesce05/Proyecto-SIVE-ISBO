
<?php

include_once('db.php');
$conexion = abrirConexion();

$IdCat = $_GET['IdCat'];
$nombreCat = obtenerCat($conexion,$IdCat);


?>

<!-- FORMULARIO DE EDITAR UNA CATEGORIA -->
<form class="formulario" action="funciones/editarCategoria.php" method="POST">

    <input type="hidden" name="IdCat"
    value="<?php
    echo $IdCat;
    ?>"
    >


    <div class="input-container">
        <label class="nombre-input" for="nombre">Nombre</label>
        <input class="field" type="text" placeholder="Nombre" name="nombreCat" maxlength="30" required
        value="<?php
        echo $nombreCat;
        ?>"
        >
    </div>  
    

    <div class="btn-enviar">
        <input type="submit" class="enviar" value="EDITAR">
    </div>
</form>