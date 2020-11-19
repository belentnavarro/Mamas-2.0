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

        <div class="container-fluid d-flex">
            <!-- Sidebar -->
            <div class="sidebar active pt-3 bg--o-dark">
                <!-- Logo -->
                <img class="ml-5" src="../Img/logo/birrete_1.png" alt="logo" width="100"/>
                <ul class="list-unstyled pt-5">
                    <!-- Links del sidebar -->
                    <?php
                    if ($_SESSION['userRol'] == 2) {
                        ?>
                        <li class="waves-effect text-light font-weight-bold mt-2">
                            <a href="crud_admin_usuarios.php" class="h4">
                                <svg class="bi ml-2" width="22" height="22" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#people-fill"/>
                                </svg>
                                Gestor de Usuarios
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                    <?php
                    if ($_SESSION['userRol'] == 2 || $_SESSION['userRol'] == 1) {
                        ?>
                        <li class="waves-effect text-light font-weight-bold mt-2">
                            <p class="h4">
                                <svg class="bi ml-2" width="22" height="22" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#journal-bookmark-fill"/>
                                </svg>
                                Gestor de Exámenes
                                <svg class="bi mr-2" width="15" height="15" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#arrow-down-circle-fill"/>
                                </svg>
                            </p>
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
                        </li>
                        <?php
                    }
                    ?>
                    <?php
                    if ($_SESSION['userRol'] == 0) {
                        ?>
                        <li class="waves-effect mt-2">
                            <p class="h4 text-light font-weight-bold">
                                <svg class="bi ml-2" width="22" height="22" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#journal-text"/>
                                </svg>
                                Exámenes
                                <svg class="bi mr-2" width="15" height="15" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#arrow-down-circle-fill"/>
                                </svg>
                            </p>
                            <ul class="list-unstyled pl-5">
                                <li class="waves-effect">
                                    <a href="" class="p-1 text--g-light font-weight-bold">
                                        Realizar exámenes
                                    </a>
                                </li>
                                <li class="waves-effect">
                                    <a href="" class="p-1 text--g-light font-weight-bold">
                                        Exámenes activos
                                    </a>
                                </li>
                                <li class="waves-effect">
                                    <a href="" class="p-1 text--g-light font-weight-bold">
                                        Exámenes realizados
                                    </a>
                                </li>
                                <li class="waves-effect">
                                    <a href="" class="p-1 text--g-light font-weight-bold">
                                        Notas
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="waves-effect mt-2">
                        <a href="../Contoller/controller.php?cerrar=1" class="h4 text-light font-weight-bold">
                            <svg class="bi ml-2" width="22" height="22" fill="currentColor">
                            <use xlink:href="../Icons/bootstrap-icons.svg#arrow-right-circle"/>
                            </svg>
                            Cerrar sesión
                        </a>
                    </li>
                </ul>
            </div>
            <div id="content">
                
            </div>

        </div>
<!--                <header>
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


