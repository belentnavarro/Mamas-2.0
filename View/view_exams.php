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

        <title>Ver examenes</title>
    </head>
    <body>
        <?php
        //Includes
        require_once '../Model/Person.php';
        require_once '../Model/PersonDAO.php';
        require_once '../Model/Exam.php';
        require_once '../Model/ExamDAO.php';
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

        // Recupero los examenes activo
        $examActiveJSON = ExamDAO::getAllActiveJSON();
        // Variable para guardar las preguntas
        $examsActive = array();
        //Decodifico el JSON y saco los usuarios del array
        $objs = json_decode($examActiveJSON, true);
        foreach ($objs as $o) {
            $examsActive[] = new Exam($o['id'], $o['dniCreator'], $o['tittle'], $o['score'], $o['startsAt'], $o['endsAt'], $o['description'], $o['subject']);
        }

        // Recupero los examenes activo
        $examNoActiveJSON = ExamDAO::getAllNoActiveJSON();
        // Variable para guardar las preguntas
        $examsNoActive = array();
        //Decodifico el JSON y saco los usuarios del array
        $objs = json_decode($examNoActiveJSON, true);
        foreach ($objs as $o) {
            $examsNoActive[] = new Exam($o['id'], $o['dniCreator'], $o['tittle'], $o['score'], $o['startsAt'], $o['endsAt'], $o['description'], $o['subject']);
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
                                <h1 class="display-2 text-white">Ver exámenes</h1>
                                <p class="text-white mt-0">Aqui podras ver tus exámenes creados.</p>
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
                                <div class="row">
                                    <div class="col font-weight-bold text-white bg--o-light display-4 text-center border-bottom">
                                        Exámenes
                                    </div>
                                </div>
                                <ul class="nav nav-tabs md-tabs border-bottom-0 mt-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="option-tab-md" data-toggle="tab" href="#option-md" role="tab" aria-controls="option-md"
                                           aria-selected="false">Activos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="writter-tab-md" data-toggle="tab" href="#writter-md" role="tab" aria-controls="writter-md"
                                           aria-selected="false">Finalizados</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Preguntas -->
                            <div class="card-body text--o-dark">
                                <div class="tab-content">

                                    <!-- Examenes activos -->
                                    <div class="tab-pane fade show active" id="option-md" role="tabpanel" aria-labelledby="option-tab-md">
                                        <!--Accordion wrapper-->
                                        <div class="accordion md-accordion" id="accordionEx1" role="tablist" aria-multiselectable="true">

                                            <?php
                                            foreach ($examsActive as $exam) {
                                                ?>
                                                <form class="card-header row border" action="../Controller/controller_create_exam.php" method="POST" name="updateExam" novalidate>
                                                    <div class="col-lg-6 col-md-12 pt-3">
                                                        <!-- Input para controlar el id del examen -->
                                                        <input type="number" name="idExman" style="display:none" value="<?=$exam->getId()?>">
                                                        <?= ucfirst($exam->getTittle()) ?>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 text-left text-md-right">
                                                        <button type="submit" class="btn btn--g-medium p-2 pr-2 " name="updateExamPage" value="updateExamPage">
                                                            Modificar
                                                            <svg class="bi ml-2" width="22" height="22" fill="currentColor">
                                                            <use xlink:href="../Icons/bootstrap-icons.svg#plus"/>
                                                            </svg>
                                                        </button>
                                                        <button type="submit" class="btn btn--o-dark p-2 pr-2 " name="deleteExamFull" value="deleteExamFull">
                                                            Eliminar
                                                            <svg class="bi ml-2" width="22" height="22" fill="currentColor">
                                                            <use xlink:href="../Icons/bootstrap-icons.svg#dash"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </form>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <!-- Accordion wrapper -->
                                    </div>

                                    <!-- Examenes no activos -->
                                    <div class="tab-pane fade" id="writter-md" role="tabpanel" aria-labelledby="writter-tab-md">
                                        <div class="accordion md-accordion" id="accordionEx2" role="tablist" aria-multiselectable="true">

                                            <?php
                                            foreach ($examsNoActive as $exam) {
                                                ?>
                                                <form class=" card-header row border" action="../Controller/controller_create_exam.php" method="POST" name="correctExam" novalidate>
                                                    <div class="col-lg-10 col-md-12 pt-3">
                                                        <!-- Input para controlar el id del examen -->
                                                        <input type="number" name="idExman" style="display:none" value="<?=$exam->getId()?>">
                                                        <?= ucfirst($exam->getTittle()) ?>
                                                    </div>
                                                    <div class="col-lg-2 col-md-12 text-left text-md-right">
                                                        <button type="submit" class="btn btn--g-medium p-2 pr-2 " name="correctExam" value="correctExam">
                                                            Corregir
                                                            <svg class="bi ml-2" width="22" height="22" fill="currentColor">
                                                            <use xlink:href="../Icons/bootstrap-icons.svg#plus"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </form>
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
</body>
</html>




