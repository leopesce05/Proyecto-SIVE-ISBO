<?php
session_start();
include('db.php');
$conexion = abrirConexion();
$correoElectronico = $_SESSION['correoElectronico'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
    <?php
    include('secciones/importes.php');
    ?>
    <link rel="stylesheet" href="css/metodoPago.css">
    <link rel="stylesheet" href="css/header.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metodo Pago</title>
</head>
<body>
    
    <?php
    include('secciones/header.php');
    ?>


    <div class="main">
        
    <div id="cambiarMetodo"  class="ocultar" onclick="cambiarMetodo()">
            <h4 class="cambiarMetodoBoton" ></i>Cambiar metodo de pago</h4>
        </div>

        <form action="funciones/comprar.php" method="POST">

            <?php
            $carrito = obtenerProductosCarrito($conexion,$correoElectronico);
            $subtotal = 0;
            if ($carrito->num_rows > 0) {
                while ($fila = $carrito->fetch_assoc()) {
                    $precio = $fila['cantidad']*$fila['precio'];
                    $subtotal = $subtotal + $precio;
            }
            }
            if (isset($_POST['IdPickUp'])) {
                $total =  $subtotal;
                ?>
                <input type="hidden" readonly name="IdPickUp" value="<?php echo $_POST['IdPickUp']?>">
                <input type="hidden" readonly name="total" value="<?php echo $total?>">

                <?php

            }elseif (isset($_POST['fechaentrega'])) {
                $total =  $subtotal+150;
                ?>
                <input type="hidden" readonly name="fechaentrega" value="<?php echo $_POST['fechaentrega']?>">
                <input type="hidden" readonly name="direccion" value="<?php echo $_POST['direccion']?>">
                <input type="hidden" readonly name="total" value="<?php echo $total?>">

                <?php

            }

            ?>

            <div id="metodoPago">

            </div>

            <div id="totalEnviar" class="ocultar">

            <?php
            
            echo "<div class='subtotalContainer'>";
            echo "<p>Total <i class='fas fa-arrow-right'></i> $".$total ."<p id='subtotal'> </p></p>";
            echo "</div>";
            ?>
            
            <input type='submit' class='finalizarCompraBoton' value='Confirmar Compra'>
        
            </div>
            </form>

        <div id="seleccion" class="seleccionarMetodoContainer">
            <div class="seleccionarMetodo">

                <h1 class="metodoTitle">Seleccione el metodo de pago</h1>


                <div id="tarjeta" onclick="cargarOpcion(this.id)" class="opcionSeleccionContainer">
                    <i class="far fa-credit-card" id="iconoMetodo"></i>
                    <h3  class="opcionSel" >Tarjeta de credito/debito</h3>
                </div>

                <div id="centroCobranza" onclick="cargarOpcion(this.id)" class="opcionSeleccionContainer">
                    <i class="fas fa-hand-holding-usd" id="iconoMetodo"></i>
                    <h3 class="opcionSel" >Pagar en centro de cobranza</h3>
                </div>
                
            </div>
        </div>  

    </div>
</body>

<script>

    //FUNCION PARA CARGAR OPCION DE PAGO
   function cargarOpcion(opcion) {

        var seleccion = document.getElementById('seleccion');
        seleccion.className += " ocultar";

        var botonCambiar = document.getElementById('cambiarMetodo');
        botonCambiar.className -= "ocultar";

        $('#metodoPago').html("");

       console.log(opcion)
       if (opcion=="centroCobranza") {
           ruta = "";
        $.ajax({
                url:'funciones/pagoCentroCobranza.php',
                type:'POST',
                data:ruta,
            })
            .done(function(res){
                $('#metodoPago').html(res);
        })

        var totalEnviar = document.getElementById('totalEnviar');
        totalEnviar.className -= "ocultar";
       }else if(opcion=="tarjeta"){

        ruta = "";
        $.ajax({
                url:'funciones/pagoTarjeta.php',
                type:'POST',
                data:ruta,
            })
            .done(function(res){
                $('#metodoPago').html(res);
        })
        var totalEnviar = document.getElementById('totalEnviar');
        totalEnviar.className -= "ocultar";
       };
   } 

//METODO PARA MOSTRAR EL CAMBIAR METODO 
   function cambiarMetodo() {
       console.log('funciona');
        var seleccion = document.getElementById('seleccion');
        seleccion.className = "seleccionarMetodoContainer";
   }
</script>
</html>