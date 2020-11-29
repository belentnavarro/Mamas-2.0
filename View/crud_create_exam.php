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

        <title>Crear examen</title>
    </head>
    <body>
        <?php
        //Includes
        require_once '../Model/Person.php';
        require_once '../Model/PersonDAO.php';
        require_once '../Model/Exam.php';
        require_once '../Model/Question.php';
        require_once '../Model/QuestionDAO.php';
        require_once '../Model/AnswerNumber.php';
        require_once '../Model/AnswerNumberDAO.php';
        require_once '../Model/AnswerTextDAO.php';
        require_once '../Model/AnswerNumberDAO.php';

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

        // Recupero las preguntas tipo numbero
        $questionNJSON = QuestionDAO::getQuestionsTypeJSON('number');
        // Variable para guardar las preguntas
        $questionN = array();
        //Decodifico el JSON y saco los usuarios del array
        $objs = json_decode($questionNJSON, true);
        foreach ($objs as $o) {
            $questionN[] = new Question($o['id'], $o['dniCreator'], $o['type'], $o['active'], $o['score'], $o['content']);
        }

        // Recupero las preguntas tipo opciones
        $questionOJSON = QuestionDAO::getQuestionsTypeJSON('option');
        // Variable para guardar las preguntas
        $questionO = array();
        //Decodifico el JSON y saco los usuarios del array
        $objs = json_decode($questionOJSON, true);
        foreach ($objs as $o) {
            $questionO[] = new Question($o['id'], $o['dniCreator'], $o['type'], $o['active'], $o['score'], $o['content']);
        }

        // Recupero las preguntas tipo redaccion
        $questionWJSON = QuestionDAO::getQuestionsTypeJSON('writter');
        // Variable para guardar las preguntas
        $questionW = array();
        //Decodifico el JSON y saco los usuarios del array
        $objs = json_decode($questionWJSON, true);
        foreach ($objs as $o) {
            $questionW[] = new Question($o['id'], $o['dniCreator'], $o['type'], $o['active'], $o['score'], $o['content']);
        }

        // Recupero las preguntas del examen de la sesión si existen
        if (isset($_SESSION['examQuestions'])) {
            $examQuestions = $_SESSION['examQuestions'];
        } else {
            $examQuestions = array();
        }
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
                                <h1 class="display-2 text-white">Crear examen</h1>
                                <p class="text-white mt-0">Está página te crear un nuevo examen añadiendo las preguntas que desees.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Administrar usuarios -->
                <div class="container-fluid mt-4">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-11">
                            <div class="card mb-0 shadow">
                                <div class="card-header font-weight-bold text-white bg--o-light display-4 text-center">
                                    Crear un examen
                                </div>
                                <div class="card-body">
                                    <div class="row border-bottom font-weight-bolder mb-4 pb-0">
                                        <div class="col">
                                            Título
                                        </div>
                                        <div class="col">
                                            Fecha de inicio
                                        </div>
                                        <div class="col">
                                            Fecha fin
                                        </div>
                                        <div class="col">
                                            Asignatura
                                        </div>
                                    </div> 
                                    <form action="../Controller/controller_create_exam.php" method="POST" name="create_new_exam">
                                        <div class="row">
                                            <div class="col mb-2 align-items-start">
                                                <input type="text" id="tittle" name="tittle" class="form-control" placeholder="Título" required>
                                            </div>
                                            <div class="col mb-2 align-items-start">
                                                <input type="date" id="startsAt" name="startsAt" class="form-control" required/>
                                            </div>
                                            <div class="col mb-2 align-items-start">
                                                <input type="date" id="endsAt" name="endsAt" class="form-control" required/>
                                            </div>
                                            <div class="col mb-2 align-items-start">
                                                <input type="text" id="subject" name="subject" class="form-control" placeholder="Asignatura" required>
                                            </div>
                                        </div>
                                        <div class="row border-bottom font-weight-bolder mb-4 pb-0">
                                            <div class="col">
                                                Descripción
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col mb-2 align-items-center">
                                                <textarea id="description" name="description" rows="3" cols="10" class="form-control" placeholder="Descripción del examen" required></textarea>
                                            </div>
                                        </div>
                                        <!-- Evaluo si las preguntas del examen estan vacias o no para mostrarlas -->
                                        <?php
                                        if (!empty($examQuestions)) {
                                            print_r($examQuestions);
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 offset-4 mt-4">
                                                <button type="submit" class="btn btn--g-medium w-100 mt-0 font-weight-bold" name="create_exam" value="create_exam">
                                                    Crear examen
                                                    <svg class="bi ml-2" width="22" height="22" fill="currentColor">
                                                    <use xlink:href="../Icons/bootstrap-icons.svg#plus-square-fill"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Listado de preguntas -->
                    <!-- Tabs superiores -->
                    <div class="row justify-content-center align-items-center mt-4">
                        <div class="col-11">
                            <div class="card mb-0 shadow">
                                <div class="card-header font-weight-bold bg--o-light display-5 text-center border-bottom-0 mb-0 pb-0">
                                    <ul class="nav nav-tabs md-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="option-tab-md" data-toggle="tab" href="#option-md" role="tab" aria-controls="option-md"
                                               aria-selected="false">Opciones</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="writter-tab-md" data-toggle="tab" href="#writter-md" role="tab" aria-controls="writter-md"
                                               aria-selected="false">Redacion</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="number-tab-md" data-toggle="tab" href="#number-md" role="tab" aria-controls="number-md"
                                               aria-selected="false">Numericas</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Preguntas -->
                                <div class="card-body text--o-dark">
                                    <div class="tab-content">

                                        <!-- Preguntas tipo Opciones -->
                                        <div class="tab-pane fade show active" id="option-md" role="tabpanel" aria-labelledby="option-tab-md">
                                            <!--Accordion wrapper-->
                                            <div class="accordion md-accordion" id="accordionEx1" role="tablist" aria-multiselectable="true">

                                                <?php
                                                foreach ($questionO as $value) {
                                                    // Evaluar si esta activa la pregunta para poder incluirla en el examen
                                                    if ($value->getActive() == 1) {

                                                        // Filtro las preguntas que ya estan en el examen para que no aparezcan
                                                        if (!in_array($value->getId(), $examQuestions)) {
                                                            // Recupero las preguntas tipo opciones
                                                            $answerTJSON = AnswerTextDAO::getAllAnswerTJSON($value->getId());
                                                            // Variable para guardar las preguntas
                                                            $answerT = array();
                                                            //Decodifico el JSON y saco los usuarios del array
                                                            $objs = json_decode($answerTJSON, true);
                                                            foreach ($objs as $o) {
                                                                $answerT[] = new AnswerText($o['id'], $o['questionId'], $o['correct'], $o['content']);
                                                            }
                                                            ?>
                                                            <!-- Accordion card -->
                                                            <form class="card" name="addQuestionExam" method="POST" action="../Controller/controller_create_exam.php">
                                                                <!-- Campo para controlar el id de pregunta -->
                                                                <input type="number" name="idQuestion" class="form-control" value="<?= $value->getId() ?>" style="display:none">
                                                                <!-- Card header -->
                                                                <div class="card-header" role="tab" id="heading<?= $value->getId() ?>">
                                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#collapse<?= $value->getId() ?>"
                                                                       aria-expanded="false" aria-controls="collapse<?= $value->getId() ?>">
                                                                        <h5 class="mb-0">
                                                                            <?= strtoupper($value->getContent()) ?> <i class="fas fa-angle-down rotate-icon"></i>
                                                                        </h5>
                                                                    </a>
                                                                </div>

                                                                <!-- Card body -->
                                                                <div id="collapse<?= $value->getId() ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?= $value->getId() ?>"
                                                                     data-parent="#accordionEx1">
                                                                    <div class="card-body bg--g-light">
                                                                        <?php
                                                                        foreach ($answerT as $a) {
                                                                            ?>
                                                                            <div class="row">
                                                                                <div class="col-10 mb-2">
                                                                                    <input type="text" name="answerOption[]" class="form-control" value="<?= $a->getContent() ?>" disabled>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                    <?php
                                                                                    if ($a->getCorrect() == 1) {
                                                                                        ?>
                                                                                        <input type="text" class="form-control" value="Correcta" disabled/>
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>
                                                                                        <input type="text" class="form-control" value="Incorrecta" disabled/>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <div class="row">
                                                                            <div class="col mr-0">
                                                                                <button class="btn btn--g-medium mr-0" type="submit" name="addQuestion" value="addQuestion">Añadir pregunta</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <!-- Accordion card -->
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <!-- Accordion wrapper -->
                                        </div>

                                        <!-- Preguntas tipo writter -->
                                        <div class="tab-pane fade" id="writter-md" role="tabpanel" aria-labelledby="writter-tab-md">
                                            <div class="accordion md-accordion" id="accordionEx2" role="tablist" aria-multiselectable="true">

                                                <?php
                                                foreach ($questionW as $value) {

                                                    // Evaluo si la pregunta esta activa
                                                    if ($value->getActive() == 1) {

                                                        // Filtro las preguntas que ya estan en el examen para que no aparezcan
                                                        if (!in_array($value->getId(), $examQuestions)) {
                                                            // Recupero las preguntas tipo redacopm
                                                            $answerWJSON = AnswerTextDAO::getAllAnswerTJSON($value->getId());
                                                            // Variable para guardar las preguntas
                                                            $answerW = array();
                                                            //Decodifico el JSON y saco los usuarios del array
                                                            $objs = json_decode($answerWJSON, true);
                                                            foreach ($objs as $o) {
                                                                $answerW[] = new AnswerText($o['id'], $o['questionId'], $o['correct'], $o['content']);
                                                            }
                                                            ?>
                                                            <!-- Accordion card -->
                                                            <form class="card" name="updateQuestionWritter" method="POST" action="../Controller/controller_create_exam.php">
                                                                <!-- Campo para controlar el id de pregunta -->
                                                                <input type="number" name="idQuestion" class="form-control" value="<?= $value->getId() ?>" style="display:none">
                                                                <!-- Card header -->
                                                                <div class="card-header" role="tab" id="heading<?= $value->getId() ?>">
                                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx2" href="#collapse<?= $value->getId() ?>"
                                                                       aria-expanded="false" aria-controls="collapse<?= $value->getId() ?>">
                                                                        <h5 class="mb-0">
                                                                            <?= strtoupper($value->getContent()) ?> <i class="fas fa-angle-down rotate-icon"></i>
                                                                        </h5>
                                                                    </a>
                                                                </div>

                                                                <!-- Card body -->
                                                                <div id="collapse<?= $value->getId() ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?= $value->getId() ?>"
                                                                     data-parent="#accordionEx2">
                                                                    <div class="card-body bg--g-light">
                                                                        <div class="row">
                                                                            <?php
                                                                            foreach ($answerW as $a) {
                                                                                ?>
                                                                                <div class="col mb-2">
                                                                                    <input type="Text" name="answerOption[]" class="form-control" value="<?= $a->getContent() ?>" disabled>
                                                                                </div>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col mr-0">
                                                                                <button class="btn btn--g-medium mr-0" type="submit" name="addQuestion" value="addQuestion">Añadir pregunta</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <!-- Accordion card -->
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <!-- Accordion wrapper -->
                                        </div>

                                        <!-- Preguntas tipo numericas -->
                                        <div class="tab-pane fade" id="number-md" role="tabpanel" aria-labelledby="number-tab-md">
                                            <div class="accordion md-accordion" id="accordionEx3" role="tablist" aria-multiselectable="true">

                                                <?php
                                                foreach ($questionN as $value) {

                                                    // Evaluo si la pregunta esta activa
                                                    if ($value->getActive() == 1) {

                                                        // Filtro las preguntas que ya estan en el examen para que no aparezcan
                                                        if (!in_array($value->getId(), $examQuestions)) {
                                                            // Recupero su respuesta
                                                            $datJSON = AnswerNumberDAO::getAnswerNJSON($value->getId());
                                                            // Decodifico el JSON y saco el usuario del array
                                                            $objs = json_decode($datJSON, true);
                                                            $o = $objs[0];
                                                            $answer = new AnswerNumber($o['id'], $o['questionId'], $o['correct'], $o['content']);
                                                            ?>
                                                            <!-- Accordion card -->
                                                            <form class="card" name="updateQuestionNumber" method="POST" action="../Controller/controller_create_exam.php">
                                                                <!-- Campo para controlar el id de pregunta -->
                                                                <input type="number" name="idQuestion" class="form-control" value="<?= $value->getId() ?>" style="display:none">
                                                                <!-- Card header -->
                                                                <div class="card-header" role="tab" id="heading<?= $value->getId() ?>">
                                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx3" href="#collapse<?= $value->getId() ?>"
                                                                       aria-expanded="false" aria-controls="collapse<?= $value->getId() ?>">
                                                                        <h5 class="mb-0">
                                                                            <?= strtoupper($value->getContent()) ?> <i class="fas fa-angle-down rotate-icon"></i>
                                                                        </h5>
                                                                    </a>
                                                                </div>

                                                                <!-- Card body -->
                                                                <div id="collapse<?= $value->getId() ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?= $value->getId() ?>"
                                                                     data-parent="#accordionEx3">
                                                                    <div class="card-body bg--g-light">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <input type="text" name="answerNumber" class="form-control" value="<?= $answer->getContent() ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col mr-0">
                                                                                <button class="btn btn--g-medium mr-0" type="submit" name="addQuestion" value="addQuestion">Añadir pregunta</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <!-- Accordion card -->
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <!-- Accordion wrapper -->
                                        </div>
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




