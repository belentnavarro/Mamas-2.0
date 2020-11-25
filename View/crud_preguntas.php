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

        <title>Administrar preguntas</title>
    </head>
    <body>
        <?php
        //Includes
        require_once '../Model/PersonDAO.php';
        require_once '../Model/Question.php';
        require_once '../Model/AnswerNumber.php';
        require_once '../Model/QuestionDAO.php';
        //require_once '../Model/QuestionTextDAO.php';
        //require_once '../Model/QuestionNumberDAO.php';
        //require_once '../Model/QuestionWrittenDAO.php';
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
                                    <a href="crud_exam.php">
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
                                <h1 class="display-2 text-white">Administrar preguntas</h1>
                                <p class="text-white mt-0">Está página te permitirá añadir, editar, eliminar o activar las respuestas para tus examenes</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Crear nueva pregunta -->
                <div class="container-fluid mt-4">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-11">
                            <form class="card mb-0 shadow" action="../Controller/controller_crud_questions.php" method="POST" name="add_question">
                                <div class="card-header font-weight-bold text-white bg--o-light display-5">
                                    <div class="row align-items-center">
                                        <div class="col mb-2">
                                            <p class="border-bottom font-weight-bold display-4 text-center">Crear una nueva pregunta</p>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-4 mb-2">
                                            <select class="custom-select" id="typeQuestionAdd" name="typeQuestionAdd" required>
                                                <option selected value="default">Seleciona el tipo de pregunta</option>
                                                <option value="option">Tipo opciones</option>
                                                <option value="writter">Tipo explicación</option>
                                                <option value="number">Tipo número</option>
                                            </select>
                                        </div>
                                        <div class="col mb-2">
                                            <button class="btn btn--g-medium p-2" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                Crear una nueva pregunta
                                                <svg class="bi" width="22" height="22" fill="currentColor">
                                                <use xlink:href="../Icons/bootstrap-icons.svg#plus"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse row" id="collapseExample">
                                    <div class="card-body font-weight-bolder mb-4 pb-0">
                                        <div class="row px-3">
                                            <div class="col mb-2">
                                                <input type="text" name="contentQuestionAdd" class="form-control" value="" placeholder="Introduce la pregunta">
                                            </div>
                                            <div class="col-2 mb-2">
                                                <input type="number" name="scoreQuestionAdd" class="form-control" value="" placeholder="Puntuación">
                                            </div>
                                            <div class="col-2 mb-2">
                                                <select class="custom-select" name="activeQuestionAdd" required>
                                                    <option selected>Activa</option>
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row px-3" id="questionOptionAdd"></div>
                                        <div class="row px-3" id="questionOptionAdd">
                                            <div class="col">
                                                <button class="btn btn--g-medium btn-block my-4" type="submit" name="addQuestion" value="login">Añadir pregunta</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Listado de preguntas -->
                    <div class="row justify-content-center align-items-center mt-4">
                        <div class="col-11">
                            <ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab-md" data-toggle="tab" href="#home-md" role="tab" aria-controls="home-md"
                                       aria-selected="true">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab-md" data-toggle="tab" href="#profile-md" role="tab" aria-controls="profile-md"
                                       aria-selected="false">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab-md" data-toggle="tab" href="#contact-md" role="tab" aria-controls="contact-md"
                                       aria-selected="false">Contact</a>
                                </li>
                            </ul>
                            <div class="tab-content card pt-5" id="myTabContentMD">
                                <div class="tab-pane fade show active" id="home-md" role="tabpanel" aria-labelledby="home-tab-md">
                                    <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua,
                                        retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica.
                                        Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry
                                        richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american
                                        apparel, butcher voluptate nisi qui.</p>
                                </div>
                                <div class="tab-pane fade" id="profile-md" role="tabpanel" aria-labelledby="profile-tab-md">
                                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.
                                        Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko
                                        farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip
                                        jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna
                                        delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan
                                        fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry
                                        richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus
                                        tattooed echo park.</p>
                                </div>
                                <div class="tab-pane fade" id="contact-md" role="tabpanel" aria-labelledby="contact-tab-md">
                                    <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo
                                        retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer,
                                        iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                                        Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles
                                        pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of
                                        them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
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



