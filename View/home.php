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
        <link rel="stylesheet" href="../Css/style.css">


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

        // Recupero datos de la sesion
        $userEmail = $_SESSION['userEmail'];
        $userRol = $_SESSION['userRol'];
        
        //Recupero los datos del usuario
        $datJSON = PersonDAO::getPersonJSON($userEmail);
        var_dump($datJSON);
        // Decodifico el JSON
        $objs = json_decode($datJSON, true);
        print_r($objs);
        foreach ($objs as $o){
            echo $o['dni'];
        }
        ?>

        <div class="wrapper d-flex align-items-stretch">
            <nav id="sidebar" class="bg--o-dark text-white">
                <div class="p-4 pt-5">
                    <img src="../Img/img_profile_users/dAPJ.png" alt="alt"class="profile logo rounded-circle mb-5"/>
                    <ul class="list-unstyled components mb-5">
                        <li class="border-bottom">
                            <a href="#">
                                <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#person"/>
                                </svg>
                                Mi perfil
                            </a>
                        </li>
                        <li class="border-bottom">
                            <a href="#">
                                <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#people"/>
                                </svg>
                                Usuarios
                            </a>
                        </li>
                        <li class="border-bottom">
                            <a href="#examSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#journal-bookmark"/>
                                </svg>
                                Examenes
                            </a>
                            <ul class="collapse list-unstyled ml-4" id="examSubmenu">
                                <li>
                                    <a href="#">
                                        <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                        <use xlink:href="../Icons/bootstrap-icons.svg#journal-plus"/>
                                        </svg>
                                        Crear examen
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                        <use xlink:href="../Icons/bootstrap-icons.svg#journal-check"/>
                                        </svg>
                                        Corregir examen
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="border-bottom">
                            <a href="#studentSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#file-earmark-text"/>
                                </svg>
                                Curso
                            </a>
                            <ul class="collapse list-unstyled ml-4" id="studentSubmenu">
                                <li>
                                    <a href="#">
                                        <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                        <use xlink:href="../Icons/bootstrap-icons.svg#file-earmark-plus"/>
                                        </svg>
                                        Realizar exámen
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                        <use xlink:href="../Icons/bootstrap-icons.svg#file-earmark-richtext"/>
                                        </svg>
                                        Exámenes activos
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                        <use xlink:href="../Icons/bootstrap-icons.svg#file-earmark-check"/>
                                        </svg>
                                        Examenes realizados
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                        <use xlink:href="../Icons/bootstrap-icons.svg#book"/>
                                        </svg>
                                        Notas
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="border-bottom">
                            <a href="../Controller/controller_home.php?cerrar=1">
                                <svg class="bi mr-2" width="22" height="22" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#arrow-right-circle"/>
                                </svg>
                                Cerrar sesión
                            </a>
                        </li>
                    </ul>

                    <div class="footer">
                        Footer
                    </div>

                </div>
            </nav>

            <!-- Contenido página  -->
            <div id="content">

                <!-- Header contenido-->
                <div class="header-home d-flex align-items-center position-relative pt-4">
                    <!-- Mask -->
                    <span class="mask bg-gradient-default opacity-8"></span>
                    <!-- Header container -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <nav class="navbar navbar-expand-lg navbar-light bg--g-light  justify-content-between">
                                    <button type="button" id="sidebarCollapse" class="btn btn--g-medium py-1 px-2">
                                        <svg class="bi" width="30" height="30" fill="currentColor">
                                        <use xlink:href="../Icons/bootstrap-icons.svg#list"/>
                                        </svg>
                                    </button>
                                    <h1 class="text-white font-weight-bolder">mamas 2.0</h1>
                                </nav>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h1 class="display-2 text-white">Hello!</h1>
                                <p class="text-white mt-0">Esta es tu agenda para hoy, actualiza tu trabajo en un solo click!</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        contenido
                    </div>
                </div>
            </div>
        </div>

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


