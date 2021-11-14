<?php

$conexion = abrirConexion();

//SELECCIONA LA INFORMACION DE LOS PRODUCTOS COMPRADOS
$sql = "SELECT P.nombre,C.cantidad,C.IdCompra,P.IdProducto,C.precio FROM producto P JOIN compraproductos C on P.IdProducto = C.IdProducto WHERE correoElectronico='".$_SESSION['correoElectronico']."' ";
$productos = $conexion->query($sql);




echo "<div class='ventas'>";
while ($fila = $productos->fetch_assoc()) {

    //SELECCIONA EL CORREO DE EL USUARIO QUE HIZO LA COMPRA
    $sql = "SELECT * FROM compra WHERE IdCompra='".$fila['IdCompra']."'";
    $usuario = $conexion->query($sql);
    $usuario = $usuario->fetch_assoc();
    $usuario = $usuario['correoElectronico'];

    $ruta = "productos/".$fila['IdProducto']."/";
    $images = glob($ruta . "/*");
    $image = $images[0];
    ?>

    <div class="venta">
        <div class="imagenProducto">
            <img class='imagen-producto' src='<?php echo $image?>'>
        </div>
        <div class="info">
        <div class="NROCompra">
            <p class='numeroCompra'>Compra: <?php echo $fila['IdCompra']?></p>
        </div>
        <div class="producto">
            <p class='nombreProducto'>Producto: <?php echo $fila['nombre']?></p>
        </div>
        <div class="cantidad">
            <p>Cantidad: <?php echo $fila['cantidad']?></p>
        </div>
        <div class="preciototal">
            <p>Precio total  <i class='fas fa-arrow-right'></i> $<?php echo $fila['precio']?></p>
        </div>
        <div class="preciototal">
            <p>REALIZADA POR <i class='fas fa-arrow-right'></i> $<?php echo $usuario?></p>
        </div>
        </div>
        
    </div>

    <?php

}
echo "</div>";

?>