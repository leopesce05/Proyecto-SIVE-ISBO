
<!-- FORMULARIO PARA AGREGAR ADMINISTRADOR -->
<form class="formulario" action="funciones/agregarAdministrador.php" method="POST">

    <!-- CORRREO -->
    <label class='correoLabel' for="correoElectronico">Correo Electronico</label>
    <input class="field" type="email" placeholder="Correo Electronico" id="correoElectronico" name="correoElectronico" maxlength="30" required
    value="<?php
    if(isset($_GET['error'])){
    echo $_GET['correo'];
    }?>">
    <?php
    //MUESTRA DIFRENTES MENSAJES
    if(isset($_GET['error'])){
        if ($_GET['error']=='existe') {
            echo "<p style='color:red'>Este usuario ya es administrador</p>";
        }elseif ($_GET['error']=='noexiste') {
            echo "<p style='color:red'>Este usuario no existe</p>";
        }
    
    }
    ?>
    <div class="btn-enviar">
        <input type="submit" class="enviar" value="AGREGAR">
    </div>
</form>