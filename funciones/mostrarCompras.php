<?php

$conexion = abrirConexion();

//SELECCIONA TODAS LAS COMPRAS DE EL USUARIO
$sql = "SELECT * FROM compra WHERE correoElectronico='".$_SESSION['correoElectronico']."' order by fecha desc";
$compras = $conexion->query($sql);


//RECORRE CADA COMPRA
echo "<div class='compras'>";
while ($fila = $compras->fetch_assoc()) {

    //SELECCIONA LOS PRODUCTOS DE CADA COMPRA
$sql = "SELECT * FROM compraproductos C join producto P on C.IdProducto=P.IdProducto WHERE C.IdCompra= '".$fila['IdCompra']."'";
$productos = $conexion->query($sql);

//SE MUESTRA TODA LA INFORMACION Y LAS FECHAS DE LA COMPRA

    $timestamp = strtotime($fila['fecha']); 
    $newDate = date("d-m-Y", $timestamp );

    $fechaentrega = strtotime($fila['fechaentrega']); 
    $fechaentrega = date("d-m-Y", $fechaentrega );
    
    ?>

    <div class="compra">
        <div class="estadoContainer <?php echo $fila['estado']?>">
            <?php echo $fila['estado']?>
        </div>
        <div class="info">
            <div class="fecha">
                <p>Fecha: <?php echo $newDate?></p>
            </div>
            <div class="numeroCompra">
                <p>Numero de compra: <?php echo $fila['IdCompra']?></p>
            </div>
            <div class="productos">
 
            <ul class="listaProds">
                <h5 class="productosTitle">Productos</h5>
            <?php
            
            while ($producto = $productos->fetch_assoc()) {
                echo "<li>".$producto['nombre']."</li>";
            }
            ?>
            </ul>

            </div>

            <div class="envioContainer">
                <div class="envio">
                <?php
                if ($fila['fechaentrega']!=NUll) {
                    echo "<p>ENVIO A DOMICILIO <i class='fas fa-arrow-right'></i> ". $fechaentrega ." </p>";
                }elseif ($fila['fechaentrega']==NUll) {
                    $sql = "SELECT * FROM puederetiraren P JOIN pickupcenter E on E.IdPickUp = P.IdPickUP WHERE P.IdCompra = '".$fila['IdCompra']."'";
                    $pickup = $conexion->query($sql);
                    $pickup = $pickup->fetch_assoc();
                    echo "<p>RETIRO EN <i class='fas fa-arrow-right'></i> ". $pickup['direccion'] ." </p>";
                }
                ?>
                </div>
                <div class="total">
                    <?php echo "<p>Precio final: $".$fila['preciofinal']."</p>"?>
                </div>

               <div class="pagar">
               <?php

                //SI LA COMPRA ESTA EN ESPERANDO PAGO, ESTO ES UN SIMULADOR QUE PAGA LA COMPRA
                if ($fila['estado']=='esperando pago') {
                    echo "<a class='pagarBtn' href='pagar.php?IdCompra=".$fila['IdCompra']."'> PAGAR </a>";
                }
                ?>
               </div>


            </div>
        </div>
    </div>

    <?php

}
echo "</div>";

?>