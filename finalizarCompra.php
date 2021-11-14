
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
    <link rel="stylesheet" href="css/finalizarCompra.css">
    <link rel="stylesheet" href="css/header.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
</head>
<body>
    <?php
    include('secciones/header.php');
    ?>

<!-- El usuario puede cambiar el metodo de envio -->
    <div class="main">
        <div id="cambiarMetodo"  class="ocultar" onclick="cambiarMetodo()">
            <h4 class="cambiarMetodoBoton" ><i class="fas fa-truck"></i>Cambiar metodo de envio</h4>
        </div>

        <!-- AQUI SE RENDERIZA EL METODO CON AJAX -->
        <div id="metodoEnvio">

        </div>

        <!-- Aqui el usuario selecciona el metodo que desea utilizar -->
        <div id="seleccion" class="seleccionarMetodoContainer">
            <div class="seleccionarMetodo">

                <h1 class="metodoTitle">Seleccione el metodo de envio</h1>


                <div id="retiro" onclick="cargarOpcion(this.id)" class="opcionSeleccionContainer">
                    <i class="fas fa-shopping-bag" id="iconoMetodo"></i>
                    <h3  class="opcionSel" >Retirar en sucursal</h3>
                </div>

                <div id="envio" onclick="cargarOpcion(this.id)" class="opcionSeleccionContainer">
                    <i class="fas fa-home" id="iconoMetodo"></i>
                    <h3 class="opcionSel" >Envio a domicilio</h3>
                </div>
                
            </div>
        </div>  

    </div>
</body>

<script>

    //RECIBE LA OPCION Y LA RENDERIZA EN EL DIV
   function cargarOpcion(opcion) {

        var seleccion = document.getElementById('seleccion');
        seleccion.className += " ocultar";

        var botonCambiar = document.getElementById('cambiarMetodo');
        botonCambiar.className -= "ocultar";

        $('#metodoEnvio').html("");

       console.log(opcion)
       if (opcion=="retiro") {
           ruta = "";
        $.ajax({
                url:'funciones/retiro.php',
                type:'POST',
                data:ruta,
            })
            .done(function(res){
                $('#metodoEnvio').html(res);
        })


       }else if(opcion=="envio"){

        ruta = "";
        $.ajax({
                url:'funciones/envio.php',
                type:'POST',
                data:ruta,
            })
            .done(function(res){
                $('#metodoEnvio').html(res);
        })

       };
   } 


   //ESTA FUNCION HACE VISIBLE EL SELECCIONADOR DE OPCION
   function cambiarMetodo() {
       console.log('funciona');
        var seleccion = document.getElementById('seleccion');
        seleccion.className = "seleccionarMetodoContainer";
   }
</script>
</html>