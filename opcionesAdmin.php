
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("secciones/importes.php");
    ?>


    <link rel="stylesheet" href="css/opcionesAdmin.css">
    <?php
    if (isset($_GET['opcion'])) {
        if ($_GET['opcion'] == 'editarUsuario') {
            echo "<link rel='stylesheet' href='css/editarUsuario.css'>";
        }elseif ($_GET['opcion'] == 'editarEmpresa') {
            echo "<link rel='stylesheet' href='css/editarEmpresa.css'>";
        }elseif ($_GET['opcion'] == 'agregarPickUp') {
            echo "<link rel='stylesheet' href='css/agregarPickUp.css'>";
        }elseif ($_GET['opcion'] == 'editarPickUp') {
            echo "<link rel='stylesheet' href='css/editarPickUp.css'>";
        }elseif ($_GET['opcion'] == 'agregarCategoria') {
            echo "<link rel='stylesheet' href='css/agregarCategoria.css'>";
        }elseif ($_GET['opcion'] == 'editarCategoria') {
            echo "<link rel='stylesheet' href='css/editarCategoria.css'>";
        }elseif ($_GET['opcion'] == 'productos') {
            echo "<link rel='stylesheet' href='css/mostrarProductos.css'>";
        }elseif ($_GET['opcion'] == 'agregarAdministrador') {
            echo "<link rel='stylesheet' href='css/agregarAdministrador.css'>";
        }
    }
    ?>
    
    
    <link rel="stylesheet" href="css/header.css">
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opciones Administrador</title>
</head>
<body>
    <?php
    include('secciones/header.php');
    ?>

    <div class="main">
        <input type="checkbox" id="check-opciones" class="check-opciones">
        <label class="tab-option" for="check-opciones"><i class="fas fa-bars"></i></label>
        <!-- OPCIONES A SELECCIOANR -->
        <div class="opciones">
            <div class="linkContainer"><a class="linkOP" href="opcionesAdmin.php?opcion=usuarios">USUARIOS</a></div>
            <div class="linkContainer"><a class="linkOP" href="opcionesAdmin.php?opcion=empresas">EMPRESAS</a></div>
            <div class="linkContainer"><a class="linkOP" href="opcionesAdmin.php?opcion=pickups">PickUps</a></div>
            <div class="linkContainer"><a class="linkOP" href="opcionesAdmin.php?opcion=categorias">CATEGORIAS</a></div>
            <div class="linkContainer"><a class="linkOP" href="opcionesAdmin.php?opcion=productos">PRODUCTOS</a></div>
            <div class="linkContainer"><a class="linkOP" href="opcionesAdmin.php?opcion=administradores">ADMINISTRADORES</a></div>
        </div>
        <!-- SE RENDERIZA LA OPCION -->
        <div class="opcion">
            <?php

            if (isset($_GET['opcion'])) {
                
                switch ($_GET['opcion']) {
                    case 'usuarios':
    
                        echo "<h1 class='opcionName'>Usuarios</h1>";
                        include('funciones/mostrarUsuarios.php');
                        mostrarUsuarios();
                        break;
    
                    case 'editarUsuario':
                        include("editarUsuario.php");
                        break;
    
                    case 'empresas':
    
                        echo "<h1 class='opcionName'>Empresas</h1>";
                        include("funciones/mostrarEmpresas.php");
                        mostrarEmpresas();
                        break;
                    
                    case 'editarEmpresa':
                        include("editarEmpresa.php");
                        break;

                    case 'pickups':
                        echo "<h1 class='opcionName'>PickUps</h1>";
                        include('funciones/mostrarPickUps.php');
                        mostrarPickUps();
                        break;

                    case 'agregarPickUp':
                        echo "<h1 class='opcionName'>Agrega un PickUP</h1>";
                        include('agregarPickUp.php');
                        break;

                    case 'editarPickUp':
                        echo "<h1 class='opcionName'>Ingrese los Cambios</h1>";
                        include('editarPickUp.php');
                        break;

                    case 'categorias':
                        echo "<h1 class='opcionName'>Categorias</h1>";
                        include('funciones/mostrarCategorias.php');
                        mostrarCategorias();
                        break;

                    case 'editarCategoria':
                        echo "<h1 class='opcionName'>Ingrese los Cambios</h1>";
                        include('editarCategoria.php');
                        break;

                    case 'agregarCategoria':
                        echo "<h1 class='opcionName'>Agregar categoria</h1>";
                        include('agregarCategoria.php');
                        break;
                    
                    case 'productos':

                        include('funciones/obtenerProductos.php');
                        $productos = obtenerProductos();
                        include('funciones/mostrarProductos.php');
                        mostrarProductos($productos);
                        break;
                    
                     case 'administradores':
                        echo "<h1 class='opcionName'>Administradores</h1>";
                        include('funciones/moderarAdministradores.php');
                        moderarAdministradores();
                        break;
                    
                    case 'agregarAdministrador':
                        echo "<h1 class='opcionName'>Agrega un administrador</h1>";
                        include('agregarAdministrador.php');
                        break;
                        
                    default:
                        
                        break;
                }
            }else{

                echo "<h1 class='opcionName'>Usuarios</h1>";
                include('funciones/mostrarUsuarios.php');
                mostrarUsuarios();
            }
            
            
            ?>
        </div>
    </div>
    <script src="js/soloLetras.js"></script>
        <script src="js/soloNumeros.js"></script>
       <script src="js/confirmarEliminarUsuario.js"></script>
</body>
</html>