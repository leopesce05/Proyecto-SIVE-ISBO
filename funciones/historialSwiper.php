
<!-- Selecciona los productos del historial si hay mas de 3-->
<?php
if (isset($_SESSION['correoElectronico'])) {
  $correoElectronico = $_SESSION['correoElectronico'];
$conexion = abrirConexion();
$sql = "SELECT * FROM Producto P join historial H on P.IdProducto=H.IdProducto AND H.correoElectronico='".$correoElectronico."' order by fecha desc LIMIT 10";
    $productos = $conexion->query($sql);
if ($productos->num_rows>3) {

?>

<!-- Crea el swiper con todos los productos -->
<div class="swiper mySwiper">
    <h3 class="SwiperTitle">Productos que visitaste recientemente</h3>
      <div class="swiper-wrapper">
        <?php
        
        
          include('funciones/mostrarProductosSwiper.php');
          mostrarProductosSwiper($productos);
        
        
        
        ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
    <?php
    }
    
}
?>