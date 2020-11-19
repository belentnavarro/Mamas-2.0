<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../Css/bootstrap.min.css">

        <!-- Material Design Bootstrap -->
        <link rel="stylesheet" href="../Css/mdb.min.css">

        <!-- App CSS -->
        <link rel="stylesheet" href="../Css/app.css">

        <!-- Font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700;900&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;400;700;900&display=swap" rel="stylesheet">

        <!--Favicon-->
        <link rel="icon" type="image/png" href="../Img/logo/favicon-birrete.png">
        
        <title>Mamas 2.0</title>
    </head>
    <body>
        <?php
        //Includes
        require_once '../Model/PersonDAO.php';
        require_once '../Model/Person.php';

        // Inicio sesión
        session_start();

        // Recupero el rol del usuario
        $userRol = $_SESSION['userRol'];
        ?>
        
        
<!--        <div class="container d-flex">
            <div class="col-3">
                 Sidebar 
            <div id="sidebar "class="side-nav fixed bg--o-dark">
                <ul class="custom-scrollbar ps lit-unstyled">
                     Logo 
                    <li class="text-center">
                        <img src="Img/logo/birrete_1.png" alt="logo">
                    </li>
                    <li>
                         Links de la sidebar 
                        <ul class="collapsible collapsible-accordion">
                            <?php 
                            if($_SESSION['userRol'] == 'administrador'){
                                ?>
                            <li class="collapsible-header waves-effect">
                                <a href="crud_admin_usuarios.php" class="waves-effect">
                                    Gestor de Usuarios
                                </a>
                            </li>
                            <?php
                            }
                            ?>
                            <?php 
                            if($_SESSION['userRol'] == 'administrador' || $_SESSION['userRol'] == 'profesor'){
                                ?>
                            <li>
                                <a class="collapsible-header waves-effect">
                                    Gestor de Exámenes <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li>
                                            <a href="" class="waves-effect">
                                                Crear examen
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="waves-effect">
                                                Exámenes
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="waves-effect">
                                                Corregir examen
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?php
                            }
                            ?>
                            <?php 
                            if($_SESSION['userRol'] == 'usuario'){
                                ?>
                            <li>
                                <a class="collapsible-header waves-effect">
                                    Exámenes <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li>
                                            <a href="" class="waves-effect">
                                                Realizar examen
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="waves-effect">
                                                Exámenes activos
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="waves-effect">
                                                Exámenes realizados
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="waves-effect">
                                                Notas
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?php
                            }
                            ?>
                    </li>
                </ul>
            </div>
            </div>
            <div class="col-9">
                Cabecera 
        <header>
            Navbar 
            <nav class="navbar navbar-expand-lg bg--o-dark fixed-top scrolling-navbar double-nav" style="padding-left: unset;">
                 SideNav botón para abrir el sidebar 
                <div class="float-left">
                    <a href="#" data-activates="slide-out" class="button-collapse">
                        <i class="fa fa-bars"></i>
                    </a> 
                    <h1 class="display-3 font-weight-bolder text-light">mamas 2.0</h1>
                </div>
                 Link editar perfil 
                <ul class="nav navbar-nav nav-flex-icons ml-auto lit-unstyled">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle waves-effect" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-user"></i>
                            <span class="clearfix d-none d-sm-inline-block text-light">Perfil</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right show" aria-labelledby="navbarDropdownMenuLink">
                            <a href="editar_perfil.php" class="dropdown-item waves-effect waves-light text-light">
                                Mi perfil
                            </a>
                        </div>                        
                    </li>
                </ul>
            </nav>
        </header>
            </div>
        </div>-->
        
        <!-- jQuery -->
        <script type="text/javascript" src="../Js/jquery.min.js"></script>

        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="../Js/popper.min.js"></script>

        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="../Js/bootstrap.min.js"></script>

        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="../Js/mdb.min.js"></script>

        <!-- APP JS -->
        <script type="text/javascript" src="../Js/app.js"></script>
    </body>
</html>


