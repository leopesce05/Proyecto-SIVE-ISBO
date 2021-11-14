<?php
function mostrarPickUps(){

    include_once('db.php');
    $conexion = abrirConexion();
    //SELECCIONA TODOS LOS PICKUPS que estan activos
    $sql= "SELECT * FROM pickupcenter WHERE estado='1'";
    $resultado = $conexion->query($sql);

    echo "<div class='agregarPickContainer'><a class='link' href='opcionesAdmin.php?opcion=agregarPickUp'>AGREGAR PickUp</a></div>";

    if ($resultado->num_rows > 0) {
        
        //RECORRE TODOS LOS PickUps
        while($fila = mysqli_fetch_assoc($resultado)){
            
            //MUESTRA LA INFORMACION Y LAS OPCIONES DE ELIMINAR Y EDITAR
            echo "<div class='userCard'>";
            echo "<div class='informacion'>";
            echo "<p class=''> <b>Nombre:  </b> ". $fila['nombre'] ."<p>";
            echo "<p class='correo'> <b>Direccion:  </b> ". $fila['direccion'] ."<p>";
            

            echo "</div>";
            echo "<div class='opcionesUser'>";
            echo "<a href='eliminarPickUp.php?Id=".$fila['IdPickUp']."'><i class='fas fa-trash-alt'></i><a/>";
            echo "<a href='opcionesAdmin.php?opcion=editarPickUp&Id=".$fila['IdPickUp']."'><i class='fas fa-user-edit'></i></a>";
            echo "</div>";
            echo "</div>";
        }   
    }else{
        echo "<h1>No hay PickUps registrados</h1>";
    }
    
}
?>