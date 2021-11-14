<?php


//FUNCION PARA CONTROLAR SI EXISTE STOCK SUFICIENTE EN COMPARACION A LA CANTIDAD DEL CARRITO
function actualizarProductos($IdCompra){

    //OBTIENE LOS PRODUCTOS DEL CARRITO
    include_once('../db.php');
    $conexion = abrirConexion();
    $carrito = obtenerProductosCarrito($conexion,$_SESSION['correoElectronico']);

    //MIENTRAS EXISTAN PRODUCTOS
    while ($fila = $carrito->fetch_assoc()) {


        $fila['precio'] = $fila['precio']*$fila['cantidad']; 
        $sql = "INSERT INTO compraproductos(IdCompra,IdProducto,cantidad,precio) VALUES ('".$IdCompra."','".$fila['IdProducto']."','".$fila['cantidad']."','".$fila['precio']."')";
        $conexion->query($sql);

        $stock = $fila['stock']-$fila['cantidad'];
        $sql = "UPDATE producto SET stock='".$stock."' WHERE IdProducto='".$fila['IdProducto']."'";
        $conexion->query($sql);

        if ($stock==0) {
            $sql = "DELETE FROM carrito WHERE IdProducto='".$fila['IdProducto']."'";
            $conexion->query($sql);
        }else{
            $sql = "UPDATE carrito SET cantidad='".$stock."' WHERE IdProducto='".$fila['IdProducto']."' AND cantidad>'".$stock."'";
            echo $stock;
            $conexion->query($sql);
        }

    }
    $sql = "DELETE FROM carrito WHERE correoElectronico='".$_SESSION['correoElectronico']."'";
    $conexion->query($sql);

}


//CONFIRMA SI LLEGARON LOS DATOS
if (isset($_POST['total'])) {
    session_start();
    include_once('../db.php');
    $conexion = abrirConexion();

    
    //OBTIENE LOS PRODUCTOS DEL CARRITO
    $carrito = obtenerProductosCarrito($conexion,$_SESSION['correoElectronico']);
    if ($carrito->num_rows>0) {

        while ($fila = $carrito->fetch_assoc()) {
        
            //CONFIRMA SI HAY STOCK SUFICIENTE
            if ($fila['cantidad'] > $fila['stock']) {
                
                header("Location:../carrito.php");
            }
            else {
                $valido = TRUE;
            }
        }
    
        //SI HAY STOCK DE TODOS LOS PRODUCTOS
        if ($valido) {
            

            //CONFIRMAR TIPO DE ENVIO
        if (isset($_POST['direccion'])) {
            $metodoEnvio = "envio";
        }elseif (isset($_POST['IdPickUp'])) {
            $metodoEnvio = "retiro";
        }
    
        //CONFIRMAR METODO DE PAGO
        if (isset($_POST['IdTarjeta'])) {
            $metodoPago =  "tarjeta";
        }elseif (!isset($_POST['IdTarjeta'])) {
            $metodoPago = "centroDeCobranza";
        }
    
        //SEGUN TIPO DE ENVIO
        switch ($metodoEnvio) {
            //ENVIO A DOMICILIO
            case 'envio':
                switch ($metodoPago) {

                    //Pago con tarjeta
                    case 'tarjeta':
                        $sql = "INSERT INTO compra(correoElectronico,estado,fechaentrega,direccionentrega,preciofinal) VALUES ('".$_SESSION['correoElectronico']."','en camino','".$_POST['fechaentrega']."','".$_POST['direccion']."','".$_POST['total']."')";
                        if ($conexion->query($sql)) {
                            $IdCompra = $conexion->insert_id;
                            
                            $sql = "INSERT INTO efectuapago(IdCompra,IdTarjeta) VALUES('".$IdCompra."','".$_POST['IdTarjeta']."')";
                            
                            if ($conexion->query($sql)) {
                                actualizarProductos($IdCompra);
                                header('Location:../datosUsuario.php?opcion=compras');
                            }else {
                              header('Location:../errorCompra.php');
                            }
                        }else{
                            header('Location:../errorCompra.php');
                        }
                        break;

                    //Pago en centor de cobranza
                    case 'centroDeCobranza':
                        $sql = "INSERT INTO compra(correoElectronico,estado,fechaentrega,direccionentrega,preciofinal) VALUES ('".$_SESSION['correoElectronico']."','esperando pago','".$_POST['fechaentrega']."','".$_POST['direccion']."','".$_POST['total']."')";
                        if ($conexion->query($sql)) {
                            $IdCompra = $conexion->insert_id;
                            actualizarProductos($IdCompra);
                            header('Location:../datosUsuario.php?opcion=compras');
                            
                        }else{
                            header('Location:../errorCompra.php');
                        }
                        break;
                }
                break;
    
            //RETIRO DE SUCURSAL
            case 'retiro':
                switch ($metodoPago) {
                    //Pago con tarjeta
                    case 'tarjeta':
                        $sql = "INSERT INTO compra(correoElectronico,estado,preciofinal) VALUES('".$_SESSION['correoElectronico']."','finalizada','".$_POST['total']."')";
                        if ($conexion->query($sql)) {
                            $IdCompra = $conexion->insert_id;
                            $sql = "INSERT INTO puederetiraren(IdCompra,IdPickUp) VALUES('".$IdCompra."','".$_POST['IdPickUp']."')";
                            if ($conexion->query($sql)) {
                                $sql = "INSERT INTO efectuapago(IdCompra,IdTarjeta) VALUES ('".$IdCompra."','".$_POST['IdTarjeta']."')";
                                if ($conexion->query($sql)) {
                                    actualizarProductos($IdCompra);
                                    header('Location:../datosUsuario.php?opcion=compras');
                                }else {
                                    header('Location:../errorCompra.php');
                                }
                            }else {
                                header('Location:../errorCompra.php');
                            }
                        }else {
                            header('Location:../errorCompra.php');
                        }
                        break;
                        
                    //Pago en centro de cobanza
                    case 'centroDeCobranza':
                        
                        $sql = "INSERT INTO compra(correoElectronico,estado,preciofinal) VALUES('".$_SESSION['correoElectronico']."','esperando pago','".$_POST['total']."')";
                        if ($conexion->query($sql)) {
                            $IdCompra = $conexion->insert_id;
                            $sql = "INSERT INTO puederetiraren(IdCompra,IdPickUp) VALUES('".$IdCompra."','".$_POST['IdPickUp']."')";
                            if ($conexion->query($sql)) {
                                    actualizarProductos($IdCompra);
                                    header('Location:../datosUsuario.php?opcion=compras');
                            }else {
                                header('Location:../errorCompra.php');
                            }
                        }else {
                            header('Location:../errorCompra.php');
                        }
                        break;
                    
                    default:
                        # code...
                        break;
                }
                break;
                break;
            
            default:
                # code...
                break;
        }
       
    }else{
        
        echo "<h2 class='CarritoVacio'>No tiene productos en el carrito</h2>"; 
    }



        }
    
        

    
}

?>