<?php

include_once("db.php");
$conexion = abrirConexion();

if (!isset($_SESSION['rol'])) {
    session_start();
 }

if (isset($_GET['correo']) && $_SESSION['rol']=='administrador') {
    $correoElectronico = $_GET['correo'];
    $datosUsuario = obtenerDatosUsuario($conexion,$correoElectronico);
}else{
    $correoElectronico = $_SESSION['correoElectronico'];
    $datosUsuario = obtenerDatosUsuario($conexion,$correoElectronico);
}

if ($datosUsuario) {
?>
        <!-- FORMULARIO DE EDICION DE USUARIO -->
        <form action="funciones/editarUsuario.php" method="POST" class="formulario">

            <h1 class="form-Name">Editar</h1>

            <input type="hidden" name="correoElectronico" 
            value="<?php
            echo $datosUsuario["correoElectronico"];
            ?>" >

            <!-- NOMBRE -->
            <div class="input-container">
            <label class="inputName" for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="field" maxlength="16" required 
            value="<?php
            echo $datosUsuario["nombre"];
            ?>" 
            >
            </div>
            <!-- APELLIDO -->
            <div class="input-container">
            <label class="inputName" for="apellido">Apellido</label>
            <input type="text" id="apellido" class="field" name="apellido" maxlength="16" required
            value="<?php
            echo $datosUsuario["apellido"];
            ?>" 
            >
            </div>
            <!-- DIRECCION -->
            <div class="input-container">
            <label class="inputName" for="direccion">Direccion</label>
            <input type="text" class="field" id="direccion" name="direccion" maxlength="40" required
            value="<?php
            echo $datosUsuario["direccion"];
            ?>" 
            >
            </div>
            <!-- CELULAR -->
            <div class="input-container">
            <label class="inputName" for="celular">Celular</label>
            <input type="text" class="field" id="celular" name="celular" required minlength="9" maxlength="9" onkeypress="return soloNumeros(event)"
            value="<?php
            echo $datosUsuario["celular"];
            ?>" 
            >
            </div>
            
            <div class="btn-enviar">
                <input type="submit" class="enviar" value="Editar">
            </div>
        </form>

<?php
}
?>