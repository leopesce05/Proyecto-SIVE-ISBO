<?php


function mostrarUsuarios(){

    include_once('db.php');
    $conexion = abrirConexion();

    //SELECCIONA TODOS LOS USUARIOS QUE ESTAN ACTIVOS
    $sql= "SELECT * FROM usuario WHERE estado = 1";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        while($fila = mysqli_fetch_assoc($resultado)){
            //CONFIRMA SI ES ADMINISTRADOR
            $rol = confirmarAdmin($conexion,$fila['correoElectronico']);
            
            //MUESTRA LA INFORMACION Y LAS OPCIONES PARA EDITAR USUARIOS
            echo "<div class='userCard'>";
            echo "<div class='informacion'>";
            echo "<p class=''> <b>Nombre:  </b> ". $fila['nombre'] ." ".$fila['apellido'] ."<p>";
            echo "<p class='correo'> <b>Correo:  </b> ". $fila['correoElectronico'] ."<p>";

            //ROL
            if ($rol == true) {
                echo "<p> <b> Rol: </b> Administrador </p>";
            }else{
                echo "<p> <b> Rol: </b> Usuario </p>";
            }

            echo "</div>";
            echo "<div class='opcionesUser'>";
            echo "<a href='eliminarUsuario.php?correo=".$fila['correoElectronico']."'><i class='fas fa-trash-alt'></i><a/>";
            echo "<a href='opcionesAdmin.php?opcion=editarUsuario&correo=".$fila['correoElectronico']."'><i class='fas fa-user-edit'></i></a>";
            echo "</div>";
            echo "</div>";
        }   
    }else{
        echo "<h1>No hay usuarios registrados</h1>";
    }
}
?>