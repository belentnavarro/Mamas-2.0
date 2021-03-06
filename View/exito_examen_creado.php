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

        <title>Examen creado</title>
    </head>
    <body>
        <?php
        //Includes
        require_once '../Model/Person.php';
        require_once '../Model/PersonDAO.php';
        require_once '../Model/Question.php';
        //require_once '../Model/QuestionText.php';
        //require_once '../Model/QuestionNumber.php';
        //require_once '../Model/QuestionWritten.php';
        //require_once '../Model/QuestionTextDAO.php';
        //require_once '../Model/QuestionNumberDAO.php';
        //require_once '../Model/QuestionWrittenDAO.php';
        require_once '../Model/Exam.php';
        //require_once '../Model/ExamDAO.php';
        // Inicio sesión
        session_start();

        // Recupero el rol del usuario
        $userRol = $_SESSION['userRol'];
        $userEmail = $_SESSION['userEmail'];

        //Recupero los datos del usuario
        $datJSON = PersonDAO::getPersonJSON($userEmail);
        // Decodifico el JSON y saco el usuario del array
        $objs = json_decode($datJSON, true);
        $o = $objs[0];
        $usuario = new Person($o['dni'], $o['name'], $o['surname'], $o['email'], $o['password'], $o['profilePhoto'], $o['rol'], $o['active']);
        // Recupero todos los usuarios
        //$datJSON = PersonDAO::getAllJSON();
        // Variable para guardar los usuarios
        //$users = array();
        // Decodifico el JSON y saco los usuarios del array
        //$objs = json_decode($datJSON, true);
        //foreach ($objs as $o) {
        //$users[] = new Person($o['dni'], $o['name'], $o['surname'], $o['email'], $o['password'], $o['profilePhoto'], $o['rol'], $o['active']);
        //}
        ?>

        <div class="wrapper d-flex align-items-stretch">
            <nav id="sidebar" class="bg--o-dark text-white">
                <div class="p-4 pt-5">
                    <img src="../Img/img_profile_users/<?= $usuario->getProfilePhoto() ?>" alt="alt" class="profile logo rounded-circle mb-5" width="150"/>
                    <ul class="list-unstyled components mb-5">
                        <li class="border-bottom">
                            <a href="home.php">
                                <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#house"/>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li class="border-bottom">
                            <a href="ver_perfil.php">
                                <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#person"/>
                                </svg>
                                Mi perfil
                            </a>
                        </li>
                        <li class="border-bottom">
                            <a href="crud_admin_usuarios.php">
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
                                    <a href="crud_create_exam.php">
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
                                <li>
                                    <a href="crud_preguntas.php">
                                        <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                        <use xlink:href="../Icons/bootstrap-icons.svg#question-square"/>
                                        </svg>
                                        BDD Preguntas
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
                                        Exámenes realizados
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
                                <nav class="navbar navbar-expand-lg justify-content-between shadow-none">
                                    <button type="button" id="sidebarCollapse" class="btn btn--g-medium py-1 px-2">
                                        <svg class="bi" width="30" height="30" fill="currentColor">
                                        <use xlink:href="../Icons/bootstrap-icons.svg#list"/>
                                        </svg>
                                    </button>
                                    <h1 class="text-white font-weight-bolder bg--o-light px-1 rounded">mamas 2.0</h1>
                                </nav>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h1 class="display-2 text-white">Examen creado</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Administrar usuarios -->
                <div class="container-fluid mt-4">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-6 col-md-6 col-sm-8 offset-lg-3 offset-md-3 offset-sm-2">
                            <div class="card mb-0 shadow">
                                <div class="card-header font-weight-bold text-white bg--o-light display-4 text-center">
                                    Examen creado con exíto
                                </div>
                                <div class="card-body">
                                    <p>Se ha creado con exito el nuevo examen, ya puedes encontrarlo dentro de la lista de exámenes para activarlo, desactivarlo o corregirlo.</p>
                                    <div class="row align-items-center">
                                        <a href="../View/crud_create_exam.php">
                                            <button type="submit" class="btn btn--g-medium w-100 mt-0 font-weight-bold col-5 w-100" name="create_exam" value="create_exam">
                                                <svg class="bi ml-2" width="22" height="22" fill="currentColor">
                                                <use xlink:href="../Icons/bootstrap-icons.svg#file-earmark-plus-fill"/>
                                                </svg>
                                                Crear nuevo examen
                                            </button>
                                            <a href="#">
                                            <button type="submit" class="btn btn--g-medium w-100 mt-0 font-weight-bold col-5 offset-1 w-100" name="create_exam" value="create_exam">
                                                Listar exámenes
                                                <svg class="bi ml-2" width="22" height="22" fill="currentColor">
                                                <use xlink:href="../Icons/bootstrap-icons.svg#arrow-right-circle-fill"/>
                                                </svg>
                                            </button>
                                        </a>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 mb-5">
                        <div class="col-6">
                            <svg class="bi" width="20" height="20" fill="currentColor">
                            <use xlink:href="../Icons/bootstrap-icons.svg#arrow-left-short"/>
                            </svg>
                            <a href="home.php" class="text--o-dark"><small>Volver al inicio</small></a>
                        </div>
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




