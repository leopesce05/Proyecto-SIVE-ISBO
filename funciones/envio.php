<!-- FORMULARIO DE ENVIO A DOMICILIO -->
<!-- FUNCIONA CON AJAX -->

<?php
    include_once('../db.php');
    $conexion = abrirConexion();
    session_start();
    $correoElectronico = $_SESSION['correoElectronico'];
    $datos = obtenerDatosUsuario($conexion,$_SESSION['correoElectronico']);
?>

<!-- TITULO -->
<h1 class="metodoEnvioTitle">ENVIO A DOMICILIO</h1>


<!-- muestra direccion de el usuario -->
<h5 class="direccion">Direccion: <?php echo $datos['direccion']?></h5>

<!-- PERMITE SELECCIONAR FECHA DE ENVIO -->
<form action="metodoPago.php" method="POST">

 <h3 class="form-title">Seleccione la fecha</h3>
 <input type="hidden" readonly name="direccion" value="<?php echo $_SESSION['direccion']?>">
 <select name="fechaentrega" id='fechaEnvioInput' required>

<?php
    
    $carrito = obtenerProductosCarrito($conexion,$correoElectronico);
    $subtotal = 0;
    if ($carrito->num_rows > 0) {
        while ($fila = $carrito->fetch_assoc()) {
            $precio = $fila['cantidad']*$fila['precio'];
            $subtotal = $subtotal + $precio;
    }
    $total =$subtotal+150;
    }

    setlocale(LC_TIME, "spanish");
    $dia = date_create();
    $dia = date_add($dia, date_interval_create_from_date_string("2 day"));
    for ($i=0; $i < 4; $i++) { 
        
        $dia = date_add($dia, date_interval_create_from_date_string("1 day"));
        $string = $dia->format('Y-m-d');
        $fecha2 = str_replace("/", "-", $string);
        $Nueva_Fecha = date("d-m-Y", strtotime($fecha2));
        $fechaESP = strftime("%A, %d de %B de %Y", strtotime($Nueva_Fecha));
        $fechaESP = utf8_encode($fechaESP);
        echo "<option value='".$string."'>".$fechaESP."</option>";
        
    }

    ?>
</select>
<input type="hidden" readonly name="total" value="<?php echo $total?>">
    <?php
    
    echo "<div class='subtotalContainer'>";
        echo "<p>Costo de envio: $150</p><br>";
    echo "</div>";
    
    echo "<div class='subtotalContainer'>";
    
    echo "<p>Total <i class='fas fa-arrow-right'></i> $".$total ."<p id='subtotal'> </p></p>";
    echo "</div>";

    echo "<input type='submit' class='finalizarCompraBoton' value='Elegir metodo de pago'>";
    ?>
</form>
