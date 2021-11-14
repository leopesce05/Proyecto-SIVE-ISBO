<?php
session_start();
if (isset($_GET['confirmar']) && $_SESSION['rol']=="administrador") {
    
    include_once('db.php');
    $conexion = abrirConexion();
        //SENTENCIAS PARA ELIMINAR CATEGORIA
    $sql = "UPDATE producto SET IdCat=NULL WHERE IdCat='".$_GET['IdCat']."'";
    echo $sql;
    if ($conexion->query($sql)==TRUE) {
        $sql = "DELETE FROM categoria WHERE IdCat='".$_GET['IdCat']."'";
        echo $sql;
        if ($conexion->query($sql)==TRUE) {
            header("Location: opcionesAdmin.php?opcion=categorias");
        }else{
            echo "ERROR CAT";
        }
    }else{
        echo "ERROR PROD";
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include('./secciones/importes.php');
    ?>
    <link rel="stylesheet" href="css/eliminarPickUp.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Categoria</title>
</head>
<body>
    <div class="main">
        <div class="confirmar">
            <p class="pregunta">¿Seguro que quiere eliminar esta categoria?</p>
            <div class="opt">
                <?php
                //CONFIRMACION
                echo "<a class='confirmar-opcion' href='eliminarCategoria.php?IdCat=".$_GET['IdCat']."&confirmar=si'>SI</a>";
                echo "<a  class='confirmar-opcion' href='opcionesAdmin.php?opcion=categorias'>NO</a>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>