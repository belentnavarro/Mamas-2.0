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
        require_once '../Model/QuestionDAO.php';
        require_once '../Model/AnswerNumber.php';
        require_once '../Model/AnswerNumberDAO.php';
        require_once '../Model/AnswerTextDAO.php';
        require_once '../Model/AnswerNumberDAO.php';
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
        ?>

        <div class="wrapper d-flex align-items-stretch">
            
            <!-- Sidebar -->
            <?php include("../Includes/sidebar.php"); ?>

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
                            <form class="card mb-0 shadow bg--g-light" action="../Controller/controller_crud_questions.php" method="POST" name="add_question">
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
                                    <div class="card-body mb-4 pb-0">
                                        <div class="row px-3 font-weight-bold text--g-dark d-none d-lg-flex">
                                            <div class="col mb-2 border-bottom">
                                                <p>Pregunta</p>
                                            </div>
                                            <div class="col-2 mb-2 border-bottom">
                                                <p>Puntuacion</p>
                                            </div>
                                            <div class="col-2 mb-2 border-bottom">
                                                <p>Activa</p>
                                            </div>
                                        </div>
                                        <div class="row px-3">
                                            <div class="col-lg col-md-12 mb-2">
                                                <input type="text" name="contentQuestionAdd" class="form-control" value="" placeholder="Introduce la pregunta">
                                            </div>
                                            <div class="col-lg col-md-12 mb-2">
                                                <input type="number" name="scoreQuestionAdd" class="form-control" value="1">
                                            </div>
                                            <div class="col-lg col-md-12 mb-2">
                                                <select class="custom-select" name="activeQuestionAdd" required>
                                                    <option value="0" selectec>No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row px-3" id="questionOptionAdd"></div>

                                        <div class="col">
                                            <button class="btn btn--g-medium btn-block my-4" type="submit" name="addQuestion" value="login">Añadir pregunta</button>
                                        </div>

                                    </div>
                                </div>
                            </form>
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
                                                    <form class="card" name="updateQuestionOption" method="POST" action="../Controller/controller_crud_questions.php">

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
                                                                <div class="row font-weight-bold text--g-dark d-none d-lg-flex">
                                                                    <div class="col mb-2 border-bottom">
                                                                        <p>Pregunta</p>
                                                                    </div>
                                                                    <div class="col-2 mb-2 border-bottom">
                                                                        <p>Puntuacion</p>
                                                                    </div>
                                                                    <div class="col-2 mb-2 border-bottom">
                                                                        <p>Activa</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg col-md-12 mb-2">
                                                                        <input type="number" name="idQuestion" class="form-control" value="<?= $value->getId() ?>" style="display:none">
                                                                        <input type="text" name="contentQuestionOption" class="form-control" value="<?= $value->getContent() ?>">
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-12 mb-2">
                                                                        <input type="number" name="scoreQuestionOption" class="form-control" value="<?= $value->getScore() ?>">
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-12 mb-2">
                                                                        <select class="custom-select" name="activeQuestionOption" required>
                                                                            <?php
                                                                            if ($value->getActive() == 1) {
                                                                                ?>
                                                                                <option value="1" selectec>Si</option>
                                                                                <option value="0">No</option>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <option value="1">Si</option>
                                                                                <option value="0" selected>No</option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                foreach ($answerT as $a) {
                                                                    ?>
                                                                    <div class="row">
                                                                        <div class="col-8 mb-2">
                                                                            <input type="text" name="answerOption[]" class="form-control" value="<?= $a->getContent() ?>">
                                                                        </div>
                                                                        <div class="col-2">
                                                                            <select class="custom-select" id="answerCorrect" name="answerCorrect[]" required>
                                                                                <?php
                                                                                if ($a->getCorrect() == 1) {
                                                                                    ?>
                                                                                    <option value="1" selected>Correcta</option>
                                                                                    <option value="0">Incorrecta</option>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                    <option value="1">Correcta</option>
                                                                                    <option value="0" selected>Incorrecta</option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <a href="#">
                                                                                <svg class="bi" width="28" height="28 " fill="currentColor"  id="updateOption">
                                                                                <use xlink:href="../Icons/bootstrap-icons.svg#trash"/>
                                                                                </svg>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                // compruebo el numero de respuestas y creo hasta 4 para dar todas las opciones al usuario.
                                                                $a = count($answerT);
                                                                while ($a < 4) {
                                                                    ?>
                                                                    <div class="row">
                                                                        <div class="col-8 mb-2">
                                                                            <input type="text" name="answerOption[]" class="form-control"value="" placeholder="Nueva respuesta">
                                                                        </div>
                                                                        <div class="col-2">
                                                                            <select class="custom-select" id="answerCorrect" name="answerCorrect[]" required>
                                                                                <option value="1" selected="">Correcta</option>
                                                                                <option value="0">Incorrecta</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <a href="#">
                                                                                <svg class="bi" width="28" height="28 " fill="currentColor"  id="updateOption">
                                                                                <use xlink:href="../Icons/bootstrap-icons.svg#trash"/>
                                                                                </svg>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    $a++;
                                                                }
                                                                ?>
                                                                <div class="row">
                                                                    <div class="col mr-0">
                                                                        <button class="btn btn--o-dark mr-0" type="submit" name="deleteQuestionOption" value="deleteQuestionOption">Borrar pregunta</button>
                                                                        <button class="btn btn--g-medium mr-0" type="submit" name="updateQuestionOption" value="updateQuestionOption">Modificar pregunta</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- Accordion card -->
                                                    <?php
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
                                                    <form class="card" name="updateQuestionWritter" method="POST" action="../Controller/controller_crud_questions.php">
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
                                                                <div class="row font-weight-bold text--g-dark d-none d-lg-flex">
                                                                    <div class="col mb-2 border-bottom">
                                                                        <p>Pregunta</p>
                                                                    </div>
                                                                    <div class="col-2 mb-2 border-bottom">
                                                                        <p>Puntuacion</p>
                                                                    </div>
                                                                    <div class="col-2 mb-2 border-bottom">
                                                                        <p>Activa</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg col-md-12 mb-2">
                                                                        <input type="number" name="idQuestion" class="form-control" value="<?= $value->getId() ?>" style="display:none">
                                                                        <input type="text" name="contentQuestionWritter" class="form-control" value="<?= $value->getContent() ?>">
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-12 mb-2">
                                                                        <input type="number" name="scoreQuestionWritter" class="form-control" value="<?= $value->getScore() ?>">
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-12 mb-2">
                                                                        <select class="custom-select" name="activeQuestionWritter" required>
                                                                            <?php
                                                                            if ($value->getActive() == 1) {
                                                                                ?>
                                                                                <option value="1" selectec>Si</option>
                                                                                <option value="0">No</option>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <option value="1">Si</option>
                                                                                <option value="0" selected>No</option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                foreach ($answerW as $a) {
                                                                    ?>
                                                                    <div class="row">
                                                                        <div class="col-8 mb-2">
                                                                            <input type="Text" name="answerOption[]" class="form-control" value="<?= $a->getContent() ?>">
                                                                        </div>
                                                                        <div class="col-1 mb-2">
                                                                            <a href="#">
                                                                                <svg class="bi" width="28" height="28 " fill="currentColor"  id="updateOption">
                                                                                <use xlink:href="../Icons/bootstrap-icons.svg#trash"/>
                                                                                </svg>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                // compruebo el numero de respuestas y creo hasta 4 para dar todas las opciones al usuario.
                                                                $a = count($answerW);
                                                                while ($a < 4) {
                                                                    ?>
                                                                    <div class="row">
                                                                        <div class="col-8 mb-2">
                                                                            <input type="text" name="answerOption[]" class="form-control" value="" placeholder="Nueva respuesta">
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <a href="#">
                                                                                <svg class="bi" width="28" height="28 " fill="currentColor"  id="updateOption">
                                                                                <use xlink:href="../Icons/bootstrap-icons.svg#trash"/>
                                                                                </svg>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    $a++;
                                                                }
                                                                ?>
                                                                <div class="row">
                                                                    <div class="col mr-0">
                                                                        <button class="btn btn--o-dark mr-0" type="submit" name="deleteQuestionWritter" value="deleteQuestionWritter">Borrar pregunta</button>
                                                                        <button class="btn btn--g-medium mr-0" type="submit" name="updateQuestionWritter" value="updateQuestionWritter">Modificar pregunta</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- Accordion card -->
                                                    <?php
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
                                                    // Recupero su respuesta
                                                    $datJSON = AnswerNumberDAO::getAnswerNJSON($value->getId());
                                                    // Decodifico el JSON y saco el usuario del array
                                                    $objs = json_decode($datJSON, true);
                                                    $o = $objs[0];
                                                    $answer = new AnswerNumber($o['id'], $o['questionId'], $o['correct'], $o['content']);
                                                    ?>
                                                    <!-- Accordion card -->
                                                    <form class="card" name="updateQuestionNumber" method="POST" action="../Controller/controller_crud_questions.php">

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
                                                                <div class="row font-weight-bold text--g-dark d-none d-lg-flex">
                                                                    <div class="col mb-2 border-bottom">
                                                                        <p>Pregunta</p>
                                                                    </div>
                                                                    <div class="col-2 mb-2 border-bottom">
                                                                        <p>Puntuacion</p>
                                                                    </div>
                                                                    <div class="col-2 mb-2 border-bottom">
                                                                        <p>Activa</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col mb-2">
                                                                        <input type="number" name="idQuestion" class="form-control" value="<?= $value->getId() ?>" style="display:none">
                                                                        <input type="text" name="contentQuestionNumber" class="form-control" value="<?= $value->getContent() ?>">
                                                                    </div>
                                                                    <div class="col-2 mb-2">
                                                                        <input type="number" name="scoreQuestionNumber" class="form-control" value="<?= $value->getScore() ?>">
                                                                    </div>
                                                                    <div class="col-2 mb-2">
                                                                        <select class="custom-select" name="activeQuestionNumber" required>
                                                                            <?php
                                                                            if ($value->getActive() == 1) {
                                                                                ?>
                                                                                <option value="1" selectec>Si</option>
                                                                                <option value="0">No</option>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <option value="1">Si</option>
                                                                                <option value="0" selected>No</option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <input type="number" name="idAnswer" class="form-control" value="<?= $answer->getId() ?>" style="display:none">
                                                                        <input type="number" name="answerNumber" class="form-control" value="<?= $answer->getContent() ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col mr-0">
                                                                        <button class="btn btn--o-dark mr-0" type="submit" name="deleteQuestionNumber" value="deleteQuestionNumber">Borrar pregunta</button>
                                                                        <button class="btn btn--g-medium mr-0" type="submit" name="updateQuestionNumber" value="updateQuestionNumber">Modificar pregunta</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- Accordion card -->
                                                    <?php
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
        <script type="text/javascript" src="../Js/crudQuestion.js"></script>

    </body>
</html>



