<?php



function obtenerProductosEmpresa(){

    if ($_SESSION['rol']== 'empresa') {
        $correoElectronico = $_SESSION['correoElectronico'];
    }else{
        $correoElectronico = $_GET['correo'];
    }

    include_once('db.php');
    $conexion = abrirConexion();

    //SELECCIONA TODOS LOS PRODUCTOS DE UNA EMPRESA
    $sql= "SELECT * FROM producto WHERE correoElectronico = '".$correoElectronico."' AND estado = 1";
    $resultado = $conexion->query($sql);

    //LOS DEVUELVE O SI ESA EMPRESA NO TIENE, MUESTRA MENSAJE DE ADVERTENVIA
    if ($resultado->num_rows > 0) {
        return $resultado;
    }else{
        echo "<h1 class='noProductosTexto'>No hay productos registrados</h1>";
        return $resultado;
    }
}
?>