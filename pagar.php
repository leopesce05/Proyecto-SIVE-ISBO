<?php
//SIMULADOR DE PAGAR COMPRA
if (isset($_GET['IdCompra'])) {

    include_once('db.php');
    $conexion = abrirConexion();

    $IdCompra = $_GET['IdCompra'];

    $sql = "select * from compra where IdCompra='".$IdCompra."'";

    $compra = $conexion->query($sql);
    $compra = $compra->fetch_assoc();
    if ($compra['fechaentrega']!= NULL) {
        $sql = "update compra set estado='finalizada' where IdCompra = '".$IdCompra."'";
        $conexion->query($sql);
        header('Location: datosUsuario.php?opcion=compras');
    }else{
        $sql = "update compra set estado='en camino' where IdCompra = '".$IdCompra."'";
        $conexion->query($sql);
        header('Location: datosUsuario.php?opcion=compras');
    }

    
}

?>