<?php

//DEFINIR DATOS DE CONEXION
define('SERVIDOR','localhost');
define('USUARIO','root');
define('CONTRA','');
define ('BD','nostraweb');


//FUNCION PARA CONECTAR A BASE DE DATOS
function abrirConexion(){

    //CREA LA CONEXION
    $conexion = mysqli_connect(SERVIDOR,USUARIO,CONTRA,BD);

    //VERIFICA LA CONEXION
    if($conexion->connect_error){
        die("error con la conexion con la BD:" . $conexion->connect_error);
    }else{
    }
    return $conexion;

}

//cerrar conexion
function cerrarConexion($conexion){
    mysqli_close($conexion);
}

//Verifica si un correo electronico ya esta en uso
function verificarCorreo($conexion, $correoElectronico){

    //Si esta usada por un usuario
    $sql = "SELECT correoElectronico FROM usuario WHERE correoElectronico = '". $correoElectronico."'";

    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0){ 
        return true;
    }else{

    //Si esta usada por una empresa

        $sql = "SELECT correoElectronico FROM empresa WHERE correoElectronico = '". $correoElectronico."'";

        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0){ 
            return true;
        }else{
            return false;
        }
    }


}

//REGISTRAR EMPRESA
function registrarEmpresa($conexion,$datos){
    
    //DEFINIR CONSULTA A LA BASE DE DATOS
    $sql = "INSERT INTO empresa(correoElectronico,nombreEmpresa,RUT,contrasena) values('". $datos['correoElectronico']."','".$datos['nombreEmpresa']."','".$datos['RUT']."','".$datos['contraseña']."')";
    echo $sql;
    $resultado = $conexion->query($sql);
    //Si la consulta es exitosa, devuelve TRUE
    if ($resultado===TRUE){ 
        return true;
    }else{
        //De lo contrario devuelve FALSE
        return false;
    }
    
}

//REGISTRAR USUARIO
function registrarUsuario($conexion,$datos){
    
    //DEFINIR CONSULTA A LA BASE DE DATOS
    $sql = "INSERT INTO usuario(correoElectronico,contrasena,nombre,apellido,direccion,celular) values('". $datos['correoElectronico']."','". $datos['contraseña']."','". $datos['nombre']."','". $datos['apellido']."','". $datos['direccion']."',". $datos['celular'].")";
    $resultado = $conexion->query($sql);
    //Si la consulta es exitosa, devuelve TRUE
    if ($resultado===TRUE){ 
        return true;
    }else{
        //De lo contrario devuelve FALSE
        return false;
    }
    
}

//Validar inicio sesion
function inicioSesion($conexion,$correoElectronico,$contraseña){

    //DEFINIR CONSULTA PARA USUARIO
    $sql = "SELECT * FROM usuario WHERE correoElectronico = '".$correoElectronico."' AND contrasena = '" . $contraseña."' AND estado=1";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0){
        $usuario = $resultado->fetch_assoc();
        //DATOS DE SESION
        session_start();
        $_SESSION['correoElectronico'] = $usuario['correoElectronico'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['apellido'] = $usuario['apellido'];
        $_SESSION['direccion'] = $usuario['direccion'];
        $_SESSION['celular'] = $usuario['celular'];

        //confirma si el usuario es administrador o usuario y le da el rol
        if (confirmarAdmin($conexion,$correoElectronico)===TRUE) {
            $_SESSION['rol'] = "administrador";
        }else{
            $_SESSION['rol'] = "usuario";

        }

        //REDIRECCIONA
        header("Location:index.php");
    }else{

        //DEFINIR CONSULTA PARA EMPRESA
        $sql = "SELECT * FROM empresa WHERE correoElectronico = '".$correoElectronico."' AND contrasena = '" . $contraseña."' AND estado = 1";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0){
            $empresa = $resultado->fetch_assoc();
            //DATOS DE SESION
            session_start();
            $_SESSION['correoElectronico'] = $empresa['correoElectronico'];
            $_SESSION['nombreEmpresa'] = $empresa['nombreEmpresa'];
            $_SESSION['RUT'] = $empresa['RUT'];
            $_SESSION['rol'] = "empresa";

            //REDIRECCIONA
            header("Location:index.php");
        }else{
            return false;
        }

    }
}

//Confirmar si es administrador
function confirmarAdmin($conexion,$correoElectronico){

    //CONSULTA
    $sql = "SELECT * FROM administrador where correoElectronico='".$correoElectronico ."'" ;

    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        return true;
    }else{
        return false;
    }

}

//OBTENER DATOS DE UN USUARIO
function obtenerDatosUsuario($conexion,$correoElectronico){

    //SENTENcia de LA CONSULTA
    $sql = "SELECT * FROM usuario WHERE correoElectronico='".$correoElectronico."'";
    $resultado = $conexion->query($sql);

    //Si el usuario existe envia los datos
    if($resultado->num_rows > 0){
        $fila = $resultado->fetch_assoc();
        return $fila;
    }else{
        echo "ERROR";
    }
}

//OBTENER DATOS DE UNA EMPRESA
function obtenerDatosEmpresa($conexion,$correoElectronico){

    //SENTENcia de LA CONSULTA
    $sql = "SELECT * FROM empresa WHERE correoElectronico='".$correoElectronico."'";
    $resultado = $conexion->query($sql);

    //Si el usuario existe envia los datos
    if($resultado->num_rows > 0){
        $fila = $resultado->fetch_assoc();
        return $fila;
    }else{
        echo "ERROR";
    }
}

//CONFIRMA SI UNA EMPRESA TIENE TARJETA ASOCIADA
function confirmarTarjetaEmpresa($conexion, $correoElectronico){
    //CONSULTA
    $sql = "SELECT IdTarjeta FROM empresa WHERE correoElectronico = '$correoElectronico'";

    //REALIZA CONSULTA
    $resultado = $conexion->query($sql);

    //SI TIENE EXITO SE ENVIA
    $fila = mysqli_fetch_assoc($resultado);
    if ($fila['IdTarjeta']==null) {
       return false;
    }else{
        return true;
    }

}

//AGREGAR TARJETA

function agregarTarjeta($conexion, $datos){
    $sql ="INSERT INTO tarjeta (numeroTarjeta,codigo,NombreDueno,ApellidoDueno,vencimiento) VALUES ('".$datos['numeroTarjeta']."','".$datos['codigo']."','".$datos['NombreDueño']."','".$datos['ApellidoDueño']."','".$datos['vencimiento']."')";
    
    $resultado = $conexion->query($sql);

    if ($resultado===true) {
        
        session_start();

        $sql = "SELECT MAX(IdTarjeta) AS IdTarjeta FROM tarjeta";
        $resultado = $conexion->query($sql);
        if ($resultado->num_rows > 0) {

            $IdTarjeta = mysqli_fetch_assoc($resultado);
        }
        if ($_SESSION['rol']==='empresa') {
        
            $sql = "UPDATE empresa set IdTarjeta = ".$IdTarjeta['IdTarjeta'] . " WHERE correoElectronico = '".$datos['correoElectronico']."'";
            
            if ($conexion->query($sql)) {
                return true;
            }else {
                return false;
            }

        }elseif ($_SESSION['rol']==='usuario' || $_SESSION['rol']==='administrador') {
            
            $sql = "INSERT INTO pagacon (correoElectronico,IdTarjeta) VALUES ('".$datos['correoElectronico']."','".$IdTarjeta['IdTarjeta']."')";

            if ($conexion->query($sql)==true) {
                return true;
            }else{
                return false;
            }

        }


    }
}

//EDITAR TARJETA

function editarTarjeta($conexion,$datos){
    $sql = "UPDATE tarjeta SET numeroTarjeta = '".$datos['numeroTarjeta'] ."', codigo = '".$datos['codigo']."', NombreDueno = '".$datos['NombreDueño']."', ApellidoDueno = '".$datos['ApellidoDueño']."', vencimiento = '".$datos['vencimiento']."' WHERE IdTarjeta = '".$datos['IdTarjeta']."'" ;

    
    if ($conexion->query($sql)) {
        header("Location: ../index.php");
    }else{
        echo "ERROR AL ACTUALIZAR TARJETA";
    }
}

//DATOS TARJETA EMPRESA

function datosTarjetaEmpresa($conexion,$correoElectronico){

    

    if ($_SESSION['rol']=='empresa') {
        $sql = "SELECT IdTarjeta from empresa WHERE correoElectronico = '".$correoElectronico."'";

        $resultado = $conexion->query($sql);
        if ($resultado->num_rows > 0) {
            $fila = mysqli_fetch_assoc($resultado);
            $IdTarjeta = $fila['IdTarjeta'];

            $sql = "SELECT * FROM tarjeta WHERE IdTarjeta = '". $IdTarjeta."'";
            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0) {
                $fila = mysqli_fetch_assoc($resultado);
                return $fila;
            }

        }
    }


}


//DATOS TARJETA

function datosTarjetaUsuario($conexion,$IdTarjeta){

        $sql = "SELECT * FROM tarjeta WHERE IdTarjeta = '". $IdTarjeta."'";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $fila = mysqli_fetch_assoc($resultado);
            return $fila;
        }

     
}





//EDITAR DATOS DE EMPRESA
function editarDatosEmpresa($conexion,$datos){

    //CONSULTA
    $sql = "UPDATE empresa SET nombreEmpresa = '".$datos['nombreEmpresa']."', RUT = '".$datos['RUT']."' WHERE correoElectronico = '".$datos['correoElectronico']."'";

    //REALIZA CONSULTA
    $resultado = $conexion->query($sql);

    //SI SE REALIZO CON EXITO ENVIA TRUE
    if ($resultado === true) {
        return true;
    }else{
        return false;
    }
}


//VENDER PRODUCTO

function venderProducto($conexion,$datos,$fotos,$correoElectronico){

    //SENTENCIAS PARA INSERTAR PRODUCTO EN BD
    $sql = "INSERT INTO producto (nombre,precio,descripcion,stock,uso,IdCat,correoElectronico) values ('".$datos['nombre']."','".$datos['precio']."','" .$datos['descripcion']."','" .$datos['stock']."','" .$datos['uso']."','" .$datos['IdCat']."','" .$correoElectronico."')";

    if ($conexion->query($sql)) {

        //GUARDA EL ULTIMO ID INSERTADO
        $IdProducto = $conexion->insert_id;

        //RUTA DE LA CARPETA DE PRODUCTOS
	$root = $_SERVER["DOCUMENT_ROOT"];        
	$ruta = '/var/www/html/s.i.v.e/productos/'.$IdProducto.'/';

        //CREA CARPETA DE PRODUCTO
        if (!file_exists($ruta)) {
            mkdir($ruta, 0777, true);
        }
        
        

        for($x=0; $x<count($fotos["fotos"]["name"]); $x++)
    {
      $file = $fotos["fotos"];
      $nombre = $file["name"][$x];
      $ruta_provisional = $file["tmp_name"][$x];

          $src = $ruta.$nombre;

          //Caragamos imagenes al servidor
          move_uploaded_file($ruta_provisional, $src);       
    }
    }

    header("Location: ../opcionesEmpresa.php");

}

//EDITAR USUARIO
function editarUsuario($conexion,$datos,$correoElectronico){

    $sql = "UPDATE usuario SET nombre='". $datos['nombre'] ."', apellido='". $datos['apellido'] ."',direccion='". $datos['direccion'] ."',celular='". $datos['celular'] ."' WHERE correoElectronico='".$correoElectronico."'";
    
    if ($conexion->query($sql)) {
        if ($datos['lugar'] == 'admin') {
            header('Location: ../opcionesAdmin.php?opcion=usuarios');
        }else{
            header('Location: ../datosUsuario.php');
        }
    }


}

//OBTENER DATOS DE UN PICKUP
function obtenerPickUp($conexion,$IdPickUp){
    //SELECCIONA LOS PICKUPS
    $sql = "SELECT * FROM pickupcenter WHERE IdPickUp ='".$IdPickUp."'";

    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        return $fila; 
    }else {
        echo "No existe el PickUp";
    }
}

//OBTENER DATOS DE UNA CATEGORIA

function obtenerCat($conexion,$IdCat){

    $sql = "SELECT * FROM categoria WHERE IdCat = '".$IdCat."'";

    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch_assoc();
    $nombreCat = $fila['nombreCat'];
    return $nombreCat;


}


//OBTENER DATOS DE UN PRODUCTO
function obtenerProducto($conexion,$IdProducto){
    $sql = "SELECT * FROM producto WHERE IdProducto = '".$IdProducto."'";

    $resultado = $conexion->query($sql);
    if ($resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc();
        return $producto;
    }else{
        $producto['stock'] = 0;
        return $producto;
    }
}


//AGREGAR UN PRCDUCTO A HISTORIAL
function agregarHistorial($conexion,$correoElectronico,$IdProducto){

    $sql = "DELETE FROM historial WHERE IdProducto = '".$IdProducto."' AND correoElectronico='".$correoElectronico."'";
    
    $conexion->query($sql);
    
    $sql = "INSERT INTO historial(IdProducto,correoElectronico) VALUES ('".$IdProducto."','".$correoElectronico."')";

    if ($conexion->query($sql)) {
        
    }
}


//PRODUCTOS HISTORIAL
function obtenerProductosHistorial($conexion,$correoElectronico){

    $sql = "SELECT * FROM producto P join historial H on P.IdProducto=H.IdProducto AND H.correoElectronico='".$correoElectronico."' order by fecha desc";
    
    if ($productos = $conexion->query($sql)) {
        return $productos;    
    }else{
        echo "<p>ERROR</p>";
    }
    
}



//OBTENER CANTIDAD DE CARRITO DE PRODUCTO, SI EXISTE
function obtenerCantidadCarrito($conexion,$IdProducto,$correoElectronico){
    $sql = "SELECT * FROM carrito WHERE correoElectronico='".$correoElectronico."' AND IdProducto='".$IdProducto."' ";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $fila=$resultado->fetch_assoc();
        return $fila['cantidad'];
    }else {
        return 1;
    }

}


//OTBENER PRODUCTOS DE CARRITO

function obtenerProductosCarrito($conexion,$correoElectronico){
    $sql = "SELECT * from carrito C join producto P ON C.IdProducto=P.IdProducto WHERE C.correoElectronico = '".$correoElectronico."'";

    $productos = $conexion->query($sql);

    return $productos;

}


//OBTENER PRODUCTOS DE CATEGORIA

function obtenerProductosCategoria($conexion,$cat){
    $sql = "SELECT * from producto WHERE IdCat='".$cat."'";

    $productos = $conexion->query($sql);

    return $productos;

}

//BUSCAR PRODUCTOS POR PALABLA

function buscarProductos($conexion,$nombre){
    $sql = "SELECT * from producto WHERE nombre LIKE '%".$nombre."%' AND estado='1'";

    $productos = $conexion->query($sql);

    return $productos;

}


?>
