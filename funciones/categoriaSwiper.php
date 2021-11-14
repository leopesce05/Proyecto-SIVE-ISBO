
<?php


//REALIZA 3 SWIPERS DE 3 CATEGORIAS PARA EL INDEX

//SELECCIONA TODAS LAS CATEGORIAS QUE TIENEN MAS DE 2 PRODUCTOS

$conexion = abrirConexion();
$sql = "select IdCat from producto GRoup by IdCat having count(*) > 2 Order by COUNT(*) desc";
$categorias = $conexion->query($sql);
if ($categorias->num_rows>0) {
$cat = $categorias->fetch_assoc();
$sql = "SELECT * from producto WHERE IdCat='".$cat['IdCat']."' AND estado = 1 LIMIT 10";
$categoria = obtenerCat($conexion,$cat['IdCat']);
    $productos = $conexion->query($sql);

?>

<!-- SWIPER 1 -->
<div class="swiper mySwiper">
    <h3 class="SwiperTitle"><?php echo $categoria?></h3>
      <div class="swiper-wrapper">
        <?php
        
        
          include_once('funciones/mostrarProductosSwiper.php');
          mostrarProductosSwiper($productos);
        
        
        
        ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
    <?php
    }
    if ($categorias->num_rows>1) {

    $cat = $categorias->fetch_assoc();
$sql = "SELECT * from producto WHERE IdCat='".$cat['IdCat']."' AND estado = 1 LIMIT 10";
$categoria = obtenerCat($conexion,$cat['IdCat']);
    $productos = $conexion->query($sql);

?>

<!-- SWIPER 2 -->
<div class="swiper mySwiper">
    <h3 class="SwiperTitle"><?php echo $categoria?></h3>
      <div class="swiper-wrapper">
        <?php
        
        
          include_once('funciones/mostrarProductosSwiper.php');
          mostrarProductosSwiper($productos);
        
        
        
        ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
    
    
    <?php
    }if ($categorias->num_rows>2) {

        $cat = $categorias->fetch_assoc();
    $sql = "SELECT * from producto WHERE IdCat='".$cat['IdCat']."' AND estado = 1 LIMIT 10";
    $categoria = obtenerCat($conexion,$cat['IdCat']);
        $productos = $conexion->query($sql);
    
    ?>
    
    <!-- SWIPER 3 -->
    <div class="swiper mySwiper">
        <h3 class="SwiperTitle"><?php echo $categoria?></h3>
          <div class="swiper-wrapper">
            <?php
            
            
              include_once('funciones/mostrarProductosSwiper.php');
              mostrarProductosSwiper($productos);
            
            
            
            ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>
        
        
        <?php
        }
    ?>