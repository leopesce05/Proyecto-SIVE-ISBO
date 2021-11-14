<?php
function moderarAdministradores(){

    include_once('db.php');
    $conexion = abrirConexion();

    //Selecciona todos los administradores
    $sql= "SELECT * FROM administrador A join usuario U on A.correoElectronico = U.correoElectronico";
    $resultado = $conexion->query($sql);

    //Si existen los muestra y muestra las opciones para eliminar
    echo "<a class='boton-cat' href='opcionesAdmin.php?opcion=agregarAdministrador'>AGREGAR</a>";

    if ($resultado->num_rows > 0) {
        while($fila = mysqli_fetch_assoc($resultado)){
            
            if ($fila['correoElectronico'] != $_SESSION['correoElectronico']) {

                echo "<div class='userCard'>";
                echo "<div class='informacion'>";
                echo "<p class=''>". $fila['correoElectronico'] ."<p>";
                echo "<p class=''>". $fila['nombre'] ." ".$fila['apellido']."<p>";
                echo "</div>";
                echo "<div class='opcionesUser'>";
                echo "<a href='eliminarAdministrador.php?correo=".$fila['correoElectronico']."'><i class='fas fa-trash-alt'></i><a/>";
                echo "</div>";
                echo "</div>";
            }
            
        }   
    }else{
        echo "<h1>No hay usuarios registrados</h1>";
    }
}
?>