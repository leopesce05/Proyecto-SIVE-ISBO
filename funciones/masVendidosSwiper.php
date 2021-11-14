
<!-- Selecciona los 10 productos mas vendidos -->
<?php
$conexion = abrirConexion();
$sql = "SELECT P.IdProducto, P.nombre, P.precio, P.descripcion, P.uso, P.stock, P.estado from compraproductos A INNER JOIN producto P on P.IdProducto = A.IdProducto WHERE P.estado='1' GROUP BY A.IdProducto ORDER BY COUNT(*) DESC LIMIT 10";
$productos = $conexion->query($sql);
if ($productos->num_rows>3) {

?>

<!-- Realiza el swiper de los mas vendidos -->
<div class="swiper mySwiper">
    <h3 class="SwiperTitle">Productos mas vendidos</h3>
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