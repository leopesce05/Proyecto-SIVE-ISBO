
<h1 class="TituloVender">Vender Producto</h1>

<form class="formulario" action="funciones/venderProducto.php" method="post" enctype="multipart/form-data">

    <input type="text" class="field" placeholder="Nombre" name="nombre" maxlength="30" required>

    <input type="text" class="field" name="precio" placeholder="Precio (pesos)" id="precio" onkeypress="return soloNumeros(event)" required maxlength="9">
    
    <textarea name="descripcion" class="desc" placeholder="Descripcion" id="" cols="50" rows="3" maxlength="400" required></textarea>
    
    <div class="usoContainer">
        <div class="uso">
            <label for="usado">Usado</label>
            <input type="radio" name="uso" id="usado" value="usado" required>
        </div>
        <div class="uso">
            <label for="nuevo">Nuevo</label>
            <input type="radio" name="uso" id="nuevo" value="nuevo" required>
        </div>

    </div>

    <input type="text" class="field" name="stock" placeholder="Stock" onkeypress="return soloNumeros(event)" maxlength="11">

    <select class="field" name="categoria" id="categoria" required>
        <option value="" disabled selected>Categoria</option>
        <?php
        include_once('funciones/obtenerCategorias.php');
        $categorias = obtenerCategorias();

        while ($fila = $categorias->fetch_assoc()) {
            echo "<option value='".$fila['IdCat']."'>".$fila['nombreCat']."</option>";
        }
        

        ?>
        
    </select>

    <div class="fotoInputContainer">
        <label for="fotos">Agregue fotos de su producto</label>
        <input type="file" name="fotos[]" id="fotos" required multiple="" value="Elegir fotos" accept="image/*">
        <input type="hidden" name="MAX_FILE_SIZE" value="8000000" />

    </div>

    <input type="submit" class="enviar" value="VENDER">

</form>