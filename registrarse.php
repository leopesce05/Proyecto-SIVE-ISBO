<?php

//Abrir conexion BD
include_once("db.php");
$conexion = abrirConexion();


//Si se registro como EMPRESA
if (isset($_POST["correoElectronicoEmpresa"])) {
    $correo = $_POST["correoElectronicoEmpresa"];
    //Verifica si ya esta en uso el correo
    if (verificarCorreo($conexion, $correo) == TRUE) {
        //Si esta en uso salta mensaje error
        $correoEmp = false;
    } else {
        //Si no esta en uso lo registra y envia a la pagina de INICIO SESION
        $datos = array(
            "correoElectronico" => $_POST["correoElectronicoEmpresa"],
            "nombreEmpresa" => $_POST["nombreEmpresa"],
            "RUT" => $_POST["RUT"],
            //ENCRIPTAR CONTRASEÑA
            "contraseña" => hash('sha512', $_POST["contraseña"])
        );
        if (registrarEmpresa($conexion, $datos) == TRUE) {
            header("Location:iniciarSesion.php?registro=exitoso");
        } else {
            $error_registrarse = TRUE;
        }
    }
} else {

    //Si se registro como USUARIO
    if (isset($_POST["correoElectronicoUsuario"])) {
        $correo = $_POST["correoElectronicoUsuario"];

        //Verifica si ya esta en uso el correo
        if (verificarCorreo($conexion, $correo) == TRUE) {

            //Si esta en uso salta mensaje error
            $correoUser = false;
        } else {

            //Si no esta en uso lo registra y envia a la pagina de INICIO SESION
            $datos = array(
                "correoElectronico" => $_POST["correoElectronicoUsuario"],
                //ENCRIPTAR CONTRASEÑA
                "contraseña" => hash('sha512', $_POST["contraseña"]),
                "nombre" => $_POST["nombre"],
                "apellido" => $_POST["apellido"],
                "direccion" => $_POST["direccion"],
                "celular" => $_POST["celular"],
            );
            if (registrarUsuario($conexion, $datos) == TRUE) {
                header("Location:iniciarSesion.php?registro=exitoso");
            } else {
                $error_registrarse = TRUE;
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('secciones/importes.php');
    ?>
    <link rel="stylesheet" href="./css/registrarse.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/headerLogo.css">
    <title>Registrarse</title>
</head>

<body>
    <?php
    //IMPORTAR HEADER
    include('secciones/headerLogo.php');
    ?>
    <div class="main">
        <div class="formularios">
        <div class="titles">
            <h1 class="title">Registrarse</h1>
            <h3 class="subtitle">Quiere registrarse como...</h3>
        </div>

        <?php

        //SI HUBO UN ERROR AL REGISTRARSE...
        if (isset($error_registrarse)) {
            echo "<h5 class='red'>ERROR AL REGISTRARSE</h5>";
        }

        ?>



        <!--SELECCION DE MODO DE REGISTRO-->
        <div class="forms-line">
        <div class="label">
            <input type="radio" id="empresa" name="opcion" class='ocultar radioEmpresa' onChange="regist()">
            <label class="lEmpresa" for="empresa">EMPRESA</label>

            <input type="radio" id="usuario" name="opcion" class='ocultar radioUsuario' onChange="regist()">
            <label class="lUsuario" for="usuario">USUARIO</label>
        </div>
        

        <!-- FORMULARIO DE REGISTRO EMPRESA, si la info fue incorrecta, se autorellena -->
        <form method='POST' action="registrarse.php" id='formEmpresa' onsubmit='return empresaValidar()' class="formulario <?php
            if (isset($_POST["correoElectronicoEmpresa"])) {
                echo "mostrar";
            } else {
                echo "ocultar";
            }
            ?>">
                <input type="email" class="field" name="correoElectronicoEmpresa" placeholder="Correo Electronico" maxlength="30" required value="
            <?php
            if (isset($_POST["correoElectronicoEmpresa"])) {
                echo $_POST["correoElectronicoEmpresa"];
            }
            ?>">
            
            <input type="text" class="field" name="nombreEmpresa" placeholder="Nombre de la Empresa" required maxlength="16" minlength="8"
            value="<?php
            if (isset($_POST["nombreEmpresa"])) {
                echo $_POST["nombreEmpresa"];
            }
            ?>">
            <input type="text" class="field" placeholder='RUT' name="RUT" onkeypress="return soloNumeros(event)" required maxlength="12" minlength="12" 
            value="<?php
            if (isset($_POST["RUT"])) {
                echo $_POST["RUT"];
            }
            ?>">
            <input type="password" class="field" name="contraseña" id="contraEmpresa" placeholder='Contraseña'>
            <input type="password" class="field" name="verifContra" id="verifContraEmpresa" placeholder='Repetir Contraseña'>
            <p class='ocultar contra_error' id='errorContraseñasEmpresa'>Las contraseñas no coinciden</p>
            <?php
            if (isset($correoEmp)) {
                echo "<p class='red'>Este correo ya esta en uso</p>";
            }
            ?>
            <div class="btn-enviar">
                <input type="submit" class="enviar" value="REGISTRAR">
            </div>
            
        </form>


        <!-- FORMULARIO DE REGISTRO USUARIO, si los datos fueron incorrectos, se autorellena -->
        <form method='POST' action="registrarse.php" id='formUsuario' onsubmit='return userValidar()' class='formulario <?php
            if (isset($_POST["correoElectronicoUsuario"])) {
                echo "mostrar";
            } else {
                if (isset($_POST["correoElectronicoEmpresa"])) {
                    echo "ocultar";
                }else{
                    echo "mostrar";
                }
                
            }
            ?>'>
            <input type="email" class="field" name="correoElectronicoUsuario" placeholder="Correo Electronico" required maxlength="30" 
            value="<?php
            if (isset($_POST["correoElectronicoUsuario"])) {
                echo $_POST["correoElectronicoUsuario"];
            }
            ?>">
            
            <div class="dobles">
                <input type="password" class="field" id='contraUsuario' name="contraseña" placeholder="Contraseña" required maxlength="16" minlength="8">
                <input type="password" class="field" id='verifcontraUsuario' name="verifContra" placeholder="Repite la contraseña" required maxlength="16" minlength="8">
            </div>
            <div class="dobles">
            <input type="text" name="nombre" class="field" placeholder="Nombre" required maxlength="16" 
            value="<?php
            if (isset($_POST["correoElectronicoUsuario"])) {
                echo $_POST["nombre"];
            }
            ?>">
            <input type="text" class="field" name="apellido" placeholder="Apellido" required maxlength="16" 
            value="<?php
            if (isset($_POST["correoElectronicoUsuario"])) {
                echo $_POST["apellido"];
            }
            ?>">
            </div>
            <input type="text" class="field" name="direccion" placeholder='Direccion de domicilio' required maxlength="40"
            value="<?php
            if (isset($_POST["correoElectronicoUsuario"])) {
                echo $_POST["direccion"];
            }
            ?>">
            <input type="text" class="field" name='celular' placeholder='Celular' onkeypress="return soloNumeros(event)" required maxlength="9" minlength="9" 
            value="<?php
            if (isset($_POST["correoElectronicoUsuario"])) {
                echo $_POST["celular"];
            }
            ?>">
            <p class='ocultar contra_error' id='errorContraseñasUser'>Las contraseñas no coinciden</p>
            <?php
            if (isset($correoUser)) {
                echo "<p class='red'>Este correo ya esta en uso</p>";
            }
            ?>
            <div class="btn-enviar">
                <input type="submit" class="enviar" value="REGISTRAR">
            </div>
            
        </form>
        </div>
        
            <div class="iniciar">
                <p class="Goiniciar">¿Ya tienes cuenta?<p>
                <a href="iniciarSesion.php" class="btn-iniciar">INICIAR SESION</a>
            </div>
        </div>
    </div>


    <script src="./js/registrarse.js"></script>
</body>

</html>