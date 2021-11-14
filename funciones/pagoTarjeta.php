

<!-- FORMULARIO DE OPCION PAGO CON TARJETA -->
<?php
session_start();
include('../db.php');
$conexion =abrirConexion();
$correoElectronico = $_SESSION['correoElectronico'];

$sql= "SELECT * FROM tarjeta T JOIN pagacon P ON T.IdTarjeta = P.IdTarjeta WHERE P.correoElectronico='".$correoElectronico."' AND T.estado='1'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    echo "<h1 class='metodoEnvioTitle'>Tarjeta</h1>";
    echo "<h4 class='metodoEnvioTitle'>Seleccione una de sus tarjetas</h4>";
    while ($fila = $resultado->fetch_assoc()) {
        $fila['numeroTarjeta'] = substr($fila['numeroTarjeta'], -4);
        ?>   
        <div class="tarjetaContainer">
            <input type="radio" name="IdTarjeta" id="<?php echo $fila['IdTarjeta']?>" value="<?php echo $fila['IdTarjeta']?>" required />
            <label for="<?php echo $fila['IdTarjeta']?>"><h4>Tarjeta termindada en: *****<?php echo $fila['numeroTarjeta']?></h4></label>
            
        </div>
        <?php  

    }
}else{
    echo "<input style='display:none' type='text' minlength='5' required>";
    echo "<h1 class='metodoEnvioTitle'>Usted no tiene tarjetas<h1>";
}

?>
