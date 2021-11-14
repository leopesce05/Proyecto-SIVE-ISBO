<?php

//CERRAR SESION
session_start();
session_destroy();
header("Location: ../index.php");


?>
