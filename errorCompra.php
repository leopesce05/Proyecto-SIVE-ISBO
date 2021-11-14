<?php

//ESTA PAGINA MUESTRA UN ERROR CUANDO EN LA COMPRA SURGE UN IMPREVISTO
session_start();

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
    <title>ERROR COMPRA</title>
</head>
<body>
    <div class="main">
        <div class="confirmar">
            <p class="pregunta">Hubo un error al realizar la compra</p>
            <div class="opt">
                <?php
                echo "<a class='confirmar-opcion' href='carrito.php'>VOLVER AL CARRITO</a>";
                
                ?>
            </div>
        </div>
    </div>
</body>
</html>