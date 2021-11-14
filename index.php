<?php
include_once('funciones/mostrarProductos.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>

<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/header.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <?php
    include('secciones/importes.php');
    ?>
    
    <link rel="stylesheet" href="css/header.css">
    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />
    <?php
    if (!isset($_GET['search'])) {
      echo "<link rel='stylesheet' href='css/mostrarProductosSwiper.css'>";
    }else{
      echo "<link rel='stylesheet' href='css/mostrarProductos.css'>";
    }
    ?>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>S.I.V.E</title>
</head>
<body>
    <!--HEADER-->
    <?php
    include('secciones/header.php');
    ?>


    <div class="main">
    
    <!-- Si se realizo una busqueda -->
    <?php
    if (isset($_GET['search']) && $_GET['search']!="") {
        $conexion = abrirConexion();
        $productos = buscarProductos($conexion,$_GET['search']);
        $cantidad = $productos->num_rows;
        echo "<h3 class='tituloBusqueda'>".$_GET['search']."</h3>";
        echo "<p class='resultados'>".$cantidad." resultados</p>";
        mostrarProductos($productos);
    }else {
    ?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="banner/1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="banner/2.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="banner/3.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

    
<!-- SWIPER DE EL HISTORIAs -->
<?php
include('funciones/historialSwiper.php');
?>

<!-- SWIPER DE MAS VENDIDOS -->
<?php
include('funciones/masVendidosSwiper.php');
?>

<!-- SWIPER DE 3 CATEGORIAS -->
<?php
include('funciones/categoriaSwiper.php');
?>







    <?php
    } 
        
    ?>
    </div>

    <!--FOOTER-->





<!-- SCRIPTS NECESAIROS PARA EL SWIPER Y EL SLIDER DE FOTOS DEL BANNER -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
      if (screen.width < 450){
  console.log("dou")
  var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 0,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
   }else if (screen.width < 800){
  console.log("dou")
  var swiper = new Swiper(".mySwiper", {
        slidesPerView: 2,
        spaceBetween: 0,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
}else{
  console.log("dou")
  var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 0,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
   }
   
$(window).resize(function(){
  if (screen.width < 450){
  console.log("dou")
  var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 0,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
   }else if (screen.width < 800){
  console.log("dou")
  var swiper = new Swiper(".mySwiper", {
        slidesPerView: 2,
        spaceBetween: 0,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
}else{
  console.log("dou")
  var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 0,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
   }

  });

      
    </script>

</body>
</html>