<!-- Fomrulario de agregar categoria -->

<form class="formulario" action="funciones/agregarCategoria.php" method="POST">
<!-- Nombre de la categoria -->
    <input class="field" type="text" placeholder="Nombre Categoria" name="nombreCat" maxlength="30" required
    value="<?php
    if(isset($_GET['error'])){
    echo $_GET['error'];
    }?>">
    <?php
    if(isset($_GET['error'])){
    echo "<p style='color:red'>Esa categoria ya existe, elija otra</p>";
    }
    ?>
    <!-- enviar boton -->
    <div class="btn-enviar">
        <input type="submit" class="enviar" value="AGREGAR">
    </div>
</form>