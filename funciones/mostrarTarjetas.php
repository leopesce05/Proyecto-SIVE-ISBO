<?php
function mostrarTarjetas(){

    include_once('db.php');
    $conexion = abrirConexion();
    $correoElectronico = $_SESSION['correoElectronico'];

    //SELECCIONA TODAS LAS TARJETAS QUE ESTAN ACTIVAS
    $sql= "SELECT * FROM tarjeta T JOIN pagacon P ON T.IdTarjeta = P.IdTarjeta WHERE P.correoElectronico='".$correoElectronico."' AND T.estado='1'";
    $resultado = $conexion->query($sql);

    //BOTON DE AGREGAR TARJETAS
    echo "<div class='agregarTarjeta'><a class='link' href='datosUsuario.php?opcion=agregarTarjetaUsuario'>AGREGAR TARJETA</a></div>";

    //Muestra todas las tarjetas, permite editar  eliminar
    if ($resultado->num_rows > 0) {
        
        while($fila = mysqli_fetch_assoc($resultado)){
            
            $fila['numeroTarjeta'] = substr($fila['numeroTarjeta'], -3);
          

            echo "<div class='userCard'>";
            echo "<div class='informacion'>";
            echo "<p class=''> <b>Numero:  </b>******* ". $fila['numeroTarjeta'] ."<p>";
            echo "<p class='correo'> <b>Nombre Dueño:  </b> ". $fila['NombreDueno'] ."<p>";
            echo "<p class='correo'> <b>Apellido Dueño:  </b> ". $fila['ApellidoDueno'] ."<p>";
            

            echo "</div>";
            echo "<div class='opcionesUser'>";
            echo "<a href='eliminarTarjeta.php?IdTarjeta=".$fila['IdTarjeta']."'><i class='fas fa-trash-alt'></i><a/>";
            echo "<a href='datosUsuario.php?opcion=editarTarjeta&Id=".$fila['IdTarjeta']."'><i class='fas fa-user-edit'></i></a>";
            echo "</div>";
            echo "</div>";
        }   
    }else{
        echo "<h1>No tiene tarjetas registradas</h1>";
    }
    
}
?>