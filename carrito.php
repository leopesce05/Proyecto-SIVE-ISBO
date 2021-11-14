<!DOCTYPE html>
<html lang="en">
<head>
<!-- JQUERY para AJAX -->
    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>

    <?php
    include('secciones/importes.php');
    ?>
    <link rel="stylesheet" href="css/carrito.css">
    <link rel="stylesheet" href="css/header.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
</head>
<body>
    <?php
    include('secciones/header.php');
    ?>

    <div class="main">

    <h2 class="CarritoTitle">Tu carrito de compras</h2>
        <div class="carrito">
            <?php
            $conexion = abrirConexion();
            //OBTIENE LOS PRODUCTOS DEL CARRITO
            $carrito = obtenerProductosCarrito($conexion,$_SESSION['correoElectronico']);
            if ($carrito->num_rows<1) {
              echo "<h2 class='CarritoVacio'>No tiene productos en el carrito</h2>";  
            }else{
                
            while ($fila = $carrito->fetch_assoc()) {

            // PARA CADA PRODUCTO MUESTRA LA FOTO Y TODA LA INFORMACION
                if ($fila['cantidad'] > $fila['stock']) {
                    $sql = "UPDATE carrito SET cantidad = '".$fila['stock']."' WHERE IdProducto = '".$fila['IdProducto']."' AND cantidad > '".$fila['stock']."' ";
                    $conexion->query($sql);
                }
                    
                $ruta = "productos/".$fila['IdProducto']."/";
                $images = glob($ruta . "/*");
                $image = $images[0];
                
                ?>  

                <div class='product-cart'>
                        <div class='foto-producto'>
                        <a href='producto.php?IdProducto=<?php echo $fila['IdProducto']?>'>
                        <figure>
                            <img class='imagen-producto' src='<?php echo $image?>'>
                        </figure>
                        </a>
                        </div>
                        <div class='info-producto'>
                            <p class='nombreProducto'><?php echo $fila['nombre']?></p>
                            <p class='precio'>$<?php echo $fila['precio']?></p>

                            <!-- DESDE ACA PUEDE CAMBIAR LA CANTIDAD -->
                            <!-- ESTA CONECTADO CON AJAX A LAS FUNCIONES DE ABAJO -->
                            <div class='cantidad'>
                                <label for="<?php echo $fila['IdProducto']?>" class="cantidad-label">Cantidad: </label>
                                <input type="number" class="cantidad-input" id="<?php echo $fila['IdProducto']?>" onchange="actualizarCarrito(this.id)" name="cantidad" max='<?php echo $fila['stock']?>' min='1' required 
                                value='<?php
                                echo obtenerCantidadCarrito($conexion,$fila['IdProducto'],$_SESSION['correoElectronico']);
                                ?>'><br>
                                
                                <p id="mensaje<?php echo $fila['IdProducto']?>"></p>
                            </div>
                            <!-- BOTON DE ELIMINAR DE CARRITO -->
                            <div class="eliminar">
                            <i id="<?php echo $fila['IdProducto']?>" class="fas fa-trash-alt" onclick="eliminarDeCarrito(this.id)"></i>
                            </div>
                        </div>
                        
                </div>
                
            <?php
            }
                //OPCION PARA FINALIZA LA COMPRA
                if ($carrito->num_rows > 0) {
                    echo "<div class='subtotalContainer'>";
                    echo "<p>Subtotal <i class='fas fa-arrow-right'></i> $<p id='subtotal'> </p></p>";
                    echo "</div>";

                    echo "<a href='finalizarCompra.php' class='finalizarCompraBoton'>FINALIZAR COMPRA</a>";
                }
            }
            
            ?>
            
        </div>
    </div>

</body>

<script>

    //ESTA FUNCION VERIFICA SI HAY STOCK SUFICIENTE PARA EL PRODUCTO QUE SE MODIFICO LA CANTIDAD
        function actualizarCarrito(IdProducto){
            
            var cantidad = document.getElementById(IdProducto).value;
            

            var ruta = "cantidad="+cantidad+"&Id="+IdProducto;
            
            $.ajax({
                url:'funciones/agregarCarrito.php',
                type:'POST',
                data:ruta,
            })
            .done(function(res){
                $('#mensaje'+IdProducto).html(res);
                actualizarSubtotal()
            })

        };

        //ELIMINA UN PRODUCTO DE CARRITO Y ACTUALIZA LA PAGINA
        function eliminarDeCarrito(IdProducto){
            console.log(IdProducto);
            var ruta = "IdProducto="+IdProducto;
            
            $.ajax({
                url:'funciones/borrarProductoCarrito.php',
                type:'POST',
                data:ruta,
            })
            .done(function(res){
                location.reload();
            })

        };

        //ACTUALIZA EL SUBTOTAL DESPUES DE CAMBIAR LA CANTIDAD DE UN PRODUCTO
        function actualizarSubtotal(){
            console.log('funciona');
            var ruta = '';
            
            $.ajax({
                url:'funciones/obtenerSubtotal.php',
                type:'POST',
                data:ruta,
            })
            .done(function(res){
                $('#subtotal').html(res);
            })

        };
        document.onload = actualizarSubtotal();
    </script>


</html>