
<?php


if (isset($_GET['IdProducto'])) {

$IdProducto = $_GET['IdProducto'];
include_once('db.php');


$conexion = abrirConexion();

$producto = obtenerProducto($conexion,$IdProducto);
if ($producto) {

    $ruta = "productos/".$producto['IdProducto']."/";
    $images = glob($ruta . "/*");
    $nombre = $producto['nombre'];
    $precio = $producto['precio'];
    $descripcion = $producto['descripcion'];
    $uso = $producto['uso'];
    $stock = $producto['stock'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("secciones/importes.php");
    ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>


    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/producto.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto['nombre'] ?></title>
</head>
<body>
    <?php
    include('secciones/header.php');
    ?>

    <?php
    if ($_SESSION['rol']=='administrador' || $_SESSION['rol']=='usuario') {

        agregarHistorial($conexion,$_SESSION['correoElectronico'],$IdProducto);    
    }

    ?>

    <div class="main">

        <!-- slider de imagenes para el producto -->
        <div class="producto-container">

        <div class="product-images">
        <div id="carouselExampleInterval" class="carousel slide carousel-dark" data-bs-ride="carousel">
            <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <?php   
                    for ($i=1; $i < sizeof($images); $i++) { 
                        $a = $i+1;
                        echo "<button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='".$i."' aria-label='Slide ".$a."'></button>";
                    }
                    ?>
                
            </div>
        
                <div class="carousel-inner">

                    <?php
                    for ($i=0; $i < sizeof($images); $i++) { 
                        if ($i==0) {
                            $a = "active";
                        }else {
                            $a = "";
                        }

                        echo "<div class='carousel-item ".$a."' data-bs-interval='100000'>";
                        echo "<img src='".$images[$i]."' class='product-imagen' />";
                        echo "</div>";
                    }
                    ?>
                    
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </button>
                
               
        </div>
        </div>
        
        <!-- INFORMACION DEL PRODUCTO -->
        <div class="product-info">
            <div class="info">
            <div class="title-prod-container">
                <h2 class="product-title"><?php echo $nombre?></h2>
            </div>
            
            <div class="desc-prod-container">
                <p class="descripcion-producto"><?php echo $descripcion?></p>
            </div>
            
            <h2 class="precio-producto">$<?php echo $precio?> <p class='chiquito'>c/u<p></h2>
            <p class="stock-producto"><?php echo $stock?> unidades disponibles</p>
<!-- CANTIDAD A COMPRAR EN CARRITO -->
            <form action="">
                
                
                <?php
                if ($_SESSION['rol']=='invitado') {
                    echo "<a href='iniciarSesion.php'  class='enviar'>INICIE SESION PARA COMPRAR</a>";
                }elseif($_SESSION['rol']=='usuario' || $_SESSION['rol']=='administrador'){
                    ?>
                    <label class="cantidad-label" for="cantidad">Cantidad: </label>  
                    <input type="hidden" readonly name="IdProducto" id="ID" value="<?php echo $IdProducto?>">
                    <input type="number" class="cantidad-input" id="cantidad" name="cantidad" max='<?php echo $stock?>' min='1' required 
                    value='<?php
                    echo obtenerCantidadCarrito($conexion,$IdProducto,$_SESSION['correoElectronico']);
                    ?>'><br>
                    <button type='button' class='enviar' id='enviar'>AGREGAR AL CARRITO</button>
                
                <?php
                }
                ?>
                
                <p class='stock-producto' id="mensaje"></p>
            </form>


           <?php
           if (isset($_SESSION['correoElectronico']) && $_SESSION['correoElectronico']== $producto['correoElectronico']|| $_SESSION['rol']=='administrador') {
            echo "<div class='opcionesProducto'>";

            echo "<a href='editarProducto.php?IdProducto=".$producto['IdProducto']."'><i class='fas fa-edit'></i></a>";
            echo "<a href='eliminarProducto.php?IdProducto=".$producto['IdProducto']."'><i class='fas fa-trash-alt'></i></a>";
           
            echo "</div>";
            }
           ?>
        
        
        </div>

        </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


    </body>

    <script>
        //SCRIPT PARA ACTUALIZAR CARRITO
        $('#enviar').click(function(){
            
            var cantidad = document.getElementById('cantidad').value;
            var Id = document.getElementById('ID').value;

            var ruta = "cantidad="+cantidad+"&Id="+Id;
            
            $.ajax({
                url:'funciones/agregarCarrito.php',
                type:'POST',
                data:ruta,
            })
            .done(function(res){
                $('#mensaje').html(res);
            })

        });
    </script>


</html>


<?php
}
}
?>