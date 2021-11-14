<?php
//RECIBE PRODUCTOS
function mostrarProductos($productos){
    echo "<div class='product-container'>";

    //PARA CADA PRODUCTO
    while ($fila = $productos->fetch_assoc()) {
        
        //CONFIRMA SI ESTAN ACTIVOS
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
        echo "</div>";
        }
        
        
    }
    echo "<div>";

}

?>