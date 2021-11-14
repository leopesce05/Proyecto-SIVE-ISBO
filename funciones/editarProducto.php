<?php



//Confirma si llega el ID del producto
if (isset($_POST["IdProducto"])){


        //INICIALIZA DATOS
        $datos['IdProducto']= $_POST["IdProducto"];
        $datos['nombre'] = $_POST['nombre'];
        $datos['precio'] = $_POST['precio'];
        $datos['descripcion'] = $_POST['descripcion'];
        $datos['uso'] = $_POST['uso'];
        $datos['stock'] = $_POST['stock'];
        $datos['IdCat'] = $_POST['categoria'];

        include_once('../db.php');
        $conexion = abrirConexion();
        session_start();
        

        //ACTUALIZA EL PRODUCTO
        $sql = "UPDATE producto SET nombre='".$datos['nombre']."',precio='".$datos['precio']."',descripcion='".$datos['descripcion']."',uso='".$datos['uso']."',stock='".$datos['stock']."',IdCat='".$datos['IdCat']."' WHERE IdProducto='".$datos['IdProducto']."'";
        if ($conexion->query($sql)) {


            //GESTIONA LAS FOTOS, crea carpeta
            $file = $_FILES["fotos"];
            $nombre = $file["name"][0];
            
            if ($nombre != "") {

                $files = glob('../productos/'.$datos['IdProducto'].'/*');
                foreach($files as $file){ 
                  if(is_file($file))
                    unlink($file); 
                }


                $ruta = '../productos/'.$datos['IdProducto']. '/';

                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                
                
        
                for($x=0; $x<count($_FILES["fotos"]["name"]); $x++)
            {
              $file = $_FILES["fotos"];
              $nombre = $file["name"][$x];
              $ruta_provisional = $file["tmp_name"][$x];
        
                  $src = $ruta.$nombre;
        
                  //Caragamos imagenes al servidor
                  move_uploaded_file($ruta_provisional, $src);       
            }


            //ACTUALIZA LOS CARRITOS QUE TIENEN MAS DE LA CANTIDAD DISPONIBLE, UNA VEZ CAMBIADO EL VALOR DEL STOCK
            $sql = "UPDATE carrito SET cantidad = '".$datos['stock']."' WHERE IdProducto = '".$datos['IdProducto']."' AND cantidad > '".$datos['stock']."' ";
            $conexion->query($sql);
            
            header("Location: ../producto.php?IdProducto=".$datos['IdProducto']."");
            }else{
                
                $sql = "UPDATE carrito SET cantidad = '".$datos['stock']."' WHERE IdProducto = '".$datos['IdProducto']."' AND cantidad > '".$datos['stock']."' ";
                $conexion->query($sql);

                header("Location: ../producto.php?IdProducto=".$datos['IdProducto']."");
            }


           
        }

}




?>