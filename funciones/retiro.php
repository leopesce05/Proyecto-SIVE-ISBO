<?php

//MUESTRA LAS OPCIONES DE RETIRO EN SUCURSAL
session_start();
    $correoElectronico = $_SESSION['correoElectronico'];
    include_once('../db.php');
    $conexion = abrirConexion();
    
    $sql= "SELECT * FROM pickupcenter WHERE estado='1'";
    $resultado = $conexion->query($sql);

    $carrito = obtenerProductosCarrito($conexion,$correoElectronico);
    $subtotal = 0;
    if ($carrito->num_rows > 0) {
        while ($fila = $carrito->fetch_assoc()) {
            $precio = $fila['cantidad']*$fila['precio'];
            $subtotal = $subtotal + $precio;
    }
        
        
    }

?>

<h1 class="metodoEnvioTitle">RETIRO</h1>

<!-- FORMULARIO DE RETIRO EN SUCURSAL -->
<form action="metodoPago.php" method="POST">

 <h3 class="form-title">Seleccione el centro de retiro</h3>
 <input type="hidden" disabled name="total" value="<?php echo $subtotal?>">

<?php

//PERMITE SELECCIONAR EL PICK UP CENTER
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            
            ?>   
            <div class="pickUpContainer">
                <input type="radio" name="IdPickUp" id="<?php echo $fila['IdPickUp']?>" value="<?php echo $fila['IdPickUp']?>" required />
                <label for="<?php echo $fila['IdPickUp']?>"><h4><?php echo $fila['nombre']?></h4><p><?php echo $fila['direccion']?></p></label>
            </div>
            <?php  

        }

        echo "<div class='subtotalContainer'>";
        echo "<p>Total <i class='fas fa-arrow-right'></i> $".$subtotal."<p id='subtotal'> </p></p>";
        echo "</div>";

        echo "<input type='submit' class='finalizarCompraBoton' value='Elegir metodo de pago'>";

    }else {
        echo "<h1>No hay centros de retiro disponibles</h1>";
    }
    

?>
</form>
