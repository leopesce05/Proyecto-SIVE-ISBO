<?php
function mostrarEmpresas(){

    include_once('db.php');
    $conexion = abrirConexion();

    //SELECCIONA TODAS LAS EMPRESAS QUE ESTEN ACTIVAS
    $sql= "SELECT * FROM empresa WHERE estado = 1";
    $resultado = $conexion->query($sql);

    //RECORRE TODAS LAS EMPRESAS
    if ($resultado->num_rows > 0) {
        while($fila = mysqli_fetch_assoc($resultado)){
            
            //Muestra toda la informacion y las opciones de eliminar y de editar
            echo "<div class='userCard'>";
            echo "<div class='informacion'>";
            echo "<p class=''> <b>Nombre:  </b> ". $fila['nombreEmpresa'] ."<p>";
            echo "<p class='correo'> <b>Correo:  </b> ". $fila['correoElectronico'] ."<p>";
            echo "<p class='rut'> <b>RUT:  </b> ". $fila['RUT'] ."<p>";
            

            echo "</div>";
            echo "<div class='opcionesUser'>";
            echo "<a href='eliminarEmpresa.php?correo=".$fila['correoElectronico']."'><i class='fas fa-trash-alt'></i><a/>";
            echo "<a href='opcionesAdmin.php?opcion=editarEmpresa&correo=".$fila['correoElectronico']."'><i class='fas fa-user-edit'></i></a>";
            echo "</div>";
            echo "</div>";
        }   
    }else{
        echo "<h1>No hay usuarios registrados</h1>";
    }
}
?>