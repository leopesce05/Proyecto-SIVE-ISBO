<?php

if (isset($_SESSION['correoElectronico'])) {
    $rol = $_SESSION['rol'];
}else{
    session_start();
    if (isset($_SESSION['correoElectronico'])) {
        $rol = $_SESSION['rol'];
    }else{
        $_SESSION['rol'] = 'invitado';
        $rol = 'invitado';
    }
}
?>
        <div class="wrapper">
            <nav>
                <input type="checkbox" id="show-buscar">
                <input type="checkbox" id="show-tabs" class="mostrar-tab">
                <div class="tabs">
                    <label for="show-tabs"><i class="fas fa-bars"></i></label>
                </div>
                <div class="content">
                    <div class="logo">
                        <a href="index.php"><img class="sivelogo" src="secciones/sivelogo.png" alt=""></a>
                    </div>
                    <ul class="links">

                        <div class="opt2">
                        <?php
                        //RESPONSIVE
                        if($rol == 'invitado'){
                            //Boton INICIAR SESION
                            echo "<a href='iniciarSesion.php' class='opt'>INICIAR SESION</a>";

                            //BOTON REGISTRARSE
                            echo "<a href='registrarse.php' class='opt'>REGISTRARSE</a>";

                        }

                        if ($rol == 'administrador') {
                            echo "<a href='opcionesAdmin.php' class='opt'>ADMINISTRADOR</a>";
                        }else {
                            if ($rol == 'empresa') {
                                echo "<a href='opcionesEmpresa.php' class='opt'>EMPRESA</a>";
                            }
                        }

                        ?>
                        </div>

                        <li class="cat">
                            <a href="#" class="categorias">Categorias</a>
                            <input type="checkbox" id="show-categorias">
                            <label for="show-categorias">Categorias</label>
                            <ul>
                                
                                <?php
                                    //MOSTRAR CATEGORIAS
                                    include("funciones/obtenerCategorias.php");
                                    $resultado = obtenerCategorias();
                                    if (isset($resultado->num_rows) && $resultado->num_rows > 0) {
                                        while ($fila = mysqli_fetch_assoc($resultado)) {
                                            echo "<li class='cats'><a href='categoria.php?cat=".$fila['IdCat']."'>".$fila['nombreCat']."</a></li>";
                                        }
                                    }else{
                                        echo "<p>No hay categorias</p>";
                                    }
                                    
                                        

                                ?>
                                <?php
                                
                                ?>
                            </ul>
                        </li>
                        <?php
                        if ($rol == 'administrador' || $rol == 'usuario') {
                            
                            echo "<li class='cat'><a href='historial.php'>Historial</a></li>";

                        }
                        ?>
                        
                        <li><label  class="label aria-label text-center m-auto text-primary g-3 text-wrap fw-bold" id="google_translate_element" fs-4> Idiomas </button></li>
                        <div id="idioma"><div > </div></div>
                    </ul>
                </div>
                
                <div class="cat2">
                    <?php
                    if ($rol == 'administrador' || $rol == 'usuario') {
                        //ICONO CARRITO
                        echo "<div class='icon-box carrito-icon'><a href='carrito.php'><i class='icon fas fa-shopping-basket'></i></a></div>";
                    }

                    //ICONO USUARIO
                    if ($rol != 'invitado') {
                        
                        //BOTON DATOS SESION
                        echo "<div class='icon-box user-icon'> <a href='datosUsuario.php'><i class='icon far fa-user-circle'></i></a></div>";

                    }
                    ?>

                    <!-- ICONO BUSCAR -->
                    <label for="show-buscar"><div class="icon-box  search-icon" id="search-icon"><i class=" icon fas fa-search"></i></div></label>
                    
                    <div class="opt1">
                    <?php
                    if($rol == 'invitado'){
                        //Boton INICIAR SESION
                        echo "<a href='iniciarSesion.php' class='opt'>INICIAR SESION</a>";

                        //BOTON REGISTRARSE
                        echo "<a href='registrarse.php' class='opt'>REGISTRARSE</a>";

                    }

                    if ($rol == 'administrador') {
                        echo "<a href='opcionesAdmin.php' class='opt'>ADMINISTRADOR</a>";
                    }else {
                        if ($rol == 'empresa') {
                            echo "<a href='opcionesEmpresa.php' class='opt'>EMPRESA</a>";
                        }
                    }

                    ?>
                    </div>
                </div>
                    

                <!--Buscador-->
                
                    <form action="index.php" class="search-box">
                        <div class="search-content">
                            <input type="text" name="search" placeholder='Busca un producto...' id="search" class="search-input">
                            <button type="submit" class="btn-buscar"><i class=" icon fas fa-search"></i></button>
                        </div>
                        <label for="show-buscar" class='cerrar-busc'><i class="fas fa-times "></i></label>
                    </form>
                
            </nav>
        </div>
