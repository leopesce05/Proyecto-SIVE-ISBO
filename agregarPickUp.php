
<!-- Formulario de insertar PickUp -->
<form class="formulario" action="funciones/agregarPickUp.php" method="POST">
<!-- Nombre -->
    <input class="field" type="text" placeholder="Nombre del PickUp" name="nombre" maxlength="30" required>
<!-- Direccion -->
    <input class="field" type="text" placeholder="Direccion" name="direccion" required maxlength="40">
<!-- Boton enviar -->
    <div class="btn-enviar">
        <input type="submit" class="enviar" value="AGREGAR">
    </div>
</form>