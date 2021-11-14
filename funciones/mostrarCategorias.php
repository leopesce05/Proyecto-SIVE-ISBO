<?php
function mostrarCategorias(){

    include_once('db.php');
    $conexion = abrirConexion();

    //SELECCIONA TODAS LAS CATEGORIAS
    $sql= "SELECT * FROM categoria";
    $resultado = $conexion->query($sql);

    echo "<a class='boton-cat' href='opcionesAdmin.php?opcion=agregarCategoria'>AGREGAR</a>";

    //PARA CADA CATEGORIA LA MUESTRA Y PERMITE ELIMINAR Y EDITAR
    if ($resultado->num_rows > 0) {
        while($fila = mysqli_fetch_assoc($resultado)){
            

            echo "<div class='userCard'>";
            echo "<div class='informacionCat'>";
            echo "<p class=''>". $fila['nombreCat'] ."<p>";

            echo "</div>";
            echo "<div class='opcionesUser'>";
            echo "<a href='eliminarCategoria.php?IdCat=".$fila['IdCat']."'><i class='fas fa-trash-alt'></i><a/>";
            echo "<a href='opcionesAdmin.php?opcion=editarCategoria&IdCat=".$fila['IdCat']."'><i class='fas fa-user-edit'></i></a>";
            echo "</div>";
            echo "</div>";
        }   
    }else{
        echo "<h1>No hay usuarios registrados</h1>";
    }
}
?>