<?php

//RECIBE LOS PRODUCTOS
function mostrarProductosSwiper($productos){
    
    //PARA CADA PRODUICTO
    while ($fila = $productos->fetch_assoc()) {

        //MUESTRA PARA INGRESAR DENTRO DEL SLIDER
        echo "<div class='swiper-slide'>";
        if ($fila['estado']=='1') {
            
            $ruta = "productos/".$fila['IdProducto']."/";
            $images = glob($ruta . "/*");
            $image = $images[0];
        
        echo "<div class='product-card'>";
                echo "<a href='producto.php?IdProducto=".$fila['IdProducto']."'>";
                echo "<figure>";
                    echo "<img class='imagen-producto' src='".$image."'>";
                echo "</figure>";
                echo "<p class='nombreProducto'>".$fila['nombre']."</p>";
                echo "<p class='precio'>$".$fila['precio']."</p>";
                echo "</a>";
        echo "</div>";
        }
        
        echo "</div>";
    }

}

?>