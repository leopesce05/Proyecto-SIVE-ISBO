
<?php

$IdProducto = $_GET['IdProducto'];

include_once('db.php');
$conexion = abrirConexion();

$datos = obtenerProducto($conexion,$IdProducto);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include('secciones/importes.php');
    ?>
    <link rel="stylesheet" href="css/venderProducto.css">
    <link rel="stylesheet" href="css/header.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $datos['nombre']?></title>
</head>
<body>
    <?php
    include('secciones/header.php');
    ?>


    <div class="main">
        <div class="opcion">
    <h1 class="TituloVender">Editar Producto</h1>

    <!-- FORMULARIO DE EDICION DE PRODUCTO -->
<form class="formulario" action="funciones/editarProducto.php" method="post" enctype="multipart/form-data">

    <input type="hidden" name="IdProducto"
    value="<?php
    echo $IdProducto;
    ?>" >
    
    <!-- Nombre -->
    <input type="text" class="field" placeholder="Nombre" name="nombre" maxlength="30" required
    value="<?php
    echo $datos['nombre'];
    ?>">

    <!-- Precio -->
    <input type="text" class="field" name="precio" placeholder="Precio (pesos)" id="precio" onkeypress="return soloNumeros(event)" required maxlength="9"
    value="<?php
    echo $datos['precio'];
    ?>">
    
    <!-- Descripcion -->
    <textarea name="descripcion" class="desc" placeholder="Descripcion" id="" cols="50" rows="3" maxlength="400" required><?php echo $datos['descripcion'];?></textarea>
    
    <!-- USO -->
    <div class="usoContainer">
        <div class="uso">
            <label for="usado">Usado</label>
            <input type="radio" name="uso" id="usado" value="usado"
            <?php
            if ($datos['uso']=='usado') {
                echo "checked";
            }
            ?>
            >
        </div>
        <div class="uso">
            <label for="nuevo">Nuevo</label>
            <input type="radio" name="uso" id="nuevo" value="nuevo"
            <?php
            if ($datos['uso']=='nuevo') {
                echo "checked";
            }
            ?>>
        </div>

    </div>

    <!-- STOCK -->
    <input type="text" class="field" name="stock" placeholder="Stock" onkeypress="return soloNumeros(event)" maxlength="11"
    value="<?php
    echo $datos['stock'];
    ?>">
    
    <!-- CATEGORIA -->
    <select class="field" name="categoria" id="categoria" required>
        <option value="" <?php
        if ($datos['IdCat']==null) {
            echo "selected";
        }
        ?> disabled>Categoria</option>
        <?php
        include_once('funciones/obtenerCategorias.php');
        $categorias = obtenerCategorias();

        while ($fila = $categorias->fetch_assoc()) {
            if ($datos['IdCat']==$fila['IdCat']) {
                $selected = 'selected';
            }else {
                $selected = "";
            }
            echo "<option ".$selected."  value='".$fila['IdCat']."'>".$fila['nombreCat']."</option>";
        }
        

        ?>
        
    </select>
<!-- FOTOS -->
    <div class="fotoInputContainer">
        <label for="fotos">CAMBIAR FOTOS DE SU PRODUCTO</label>
        <input type="file" name="fotos[]" id="fotos"  multiple="" value="Elegir fotos" accept="image/*">
        <input type="hidden" name="MAX_FILE_SIZE" value="8000000" />

    </div>

    <input type="submit" class="enviar" value="GUARDAR">

</form>

    </div>
    </div>
<script src="js/soloNumeros.js"></script>
</body>
</html>