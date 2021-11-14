<?php

//FUNCIONAMIENTO CON AJAX


//Confirma si llegaron los datos
if (isset($_POST['cantidad'])) {
    session_start();

    //INICIALIZA LOS DATOS
    $IdProducto = $_POST['Id'];
    $cantidad = $_POST['cantidad'];
    $correoElectronico = $_SESSION['correoElectronico'];

    include_once('../db.php');
    $conexion = abrirConexion();
    

    //selecciona si ya existe el producto en el carrito
    $sql= "SELECT * FROM carrito WHERE correoElectronico = '".$correoElectronico."' AND IdProducto='".$IdProducto."'";
    $resultado = $conexion->query($sql);

    $datos = obtenerProducto($conexion,$IdProducto);
    $stock = $datos['stock'];

    if ($resultado->num_rows > 0) {

    //Si el producto ya esta en el carrito 

        //Si no hay stock suficiente
        if ($stock < $cantidad) {
            echo 'Error,stock insuficiente';

        //Si hay stock suficiente
        }else {
        
            $fila = $resultado->fetch_assoc();
            if ($fila['cantidad']==$cantidad) {
                echo "Producto ya agregado";
            }else{
                $sql = "UPDATE carrito SET cantidad = ".$cantidad." WHERE IdProducto='".$IdProducto."' AND correoElectronico = '".$correoElectronico."' ";
                if ($conexion->query($sql)) {
                    echo "Cantidad modificada";
                    
                }    
            }
           
        }
       
    //Si el producto no esta en el carrito
    }else{
        //Si no hay stock para agregarlo
        if ($stock < $cantidad) {

            echo "Error, stock insuficiente";

        //Si hay stock suficiente lo agrega
        }else {
         
            if ($cantidad > 0) {
                $sql ="INSERT INTO carrito(correoElectronico,cantidad,IdProducto) VALUES ('".$correoElectronico."','".$cantidad."','".$IdProducto."')";
                if ($conexion->query($sql)) {
                echo "Producto agregado al carrito";
            }
            }else{
                echo "La cantidad no puede ser 0";
            }
            
        }
        
    }
}

?>