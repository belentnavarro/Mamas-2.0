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

        <title>Añadir preguntas al examen</title>
    </head>
    <body>
        <?php
        //Includes
        require_once '../Model/Person.php';
        require_once '../Model/PersonDAO.php';
        require_once '../Model/Question.php';
        require_once '../Model/QuestionText.php';
        require_once '../Model/QuestionNumber.php';
        require_once '../Model/QuestionWritten.php';
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
        
        //Recupero el examen que estamos creando
        $exam = $_SESSION['exam-created'];
        
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
                                <h1 class="display-2 text-white">Crear examen</h1>
                                <p class="text-white mt-0">Está página te permite crear un nuevo examen añadiendo las preguntas que desees.</p>
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
                                    Preguntas añadidas
                                </div>
                                <div class="card-body">
                                    <div class="row border-bottom font-weight-bolder mb-4 pb-0">
                                        <div class="col">
                                            Pregunta
                                        </div>
                                        <div class="col">
                                            Tipo
                                        </div>
                                        <div class="col">
                                            Puntuación
                                        </div>
                                        <div class="col">
                                            Correcta
                                        </div>
                                        <div class="col">
                                            Acciones
                                        </div>
                                    </div> 
                                    <form action="../Controller/controller_create_exam.php" method="POST" name="create_new_exam">
                                        <div class="row">
                                            <div class="col mb-2 align-items-start">
                                                <input type="text" id="tittle" name="tittle" class="form-control" placeholder="Título" required>
                                            </div>
                                            <div class="col mb-2 align-items-center">
                                                <textarea id="description" name="description" rows="6" cols="10" class="form-control" placeholder="Descripción del examen" required></textarea>
                                            </div>
                                            <div class="col mb-2 align-items-start">
                                                <input type="date" id="startsAt" name="startsAt" class="form-control"/>
                                            </div>
                                            <div class="col mb-2 align-items-start">
                                                <input type="date" id="endsAt" name="endsAt" class="form-control"/>
                                            </div>
                                            <div class="col">
                                                Acciones
                                            </div>
                                        </div>
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
                    <div class="row justify-content-center align-items-center">
                        <div class="col-11">
                            <div class="card mb-0 shadow">
                                <div class="card-header font-weight-bold text-white bg--o-light display-4 text-center">
                                    Lista de preguntas
                                </div>
                                <div class="card-body">
                                    <div class="row border-bottom font-weight-bolder mb-4 pb-0">
                                        <div class="col">
                                            Título
                                        </div>
                                        <div class="col">
                                            Descripción
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
                                            <div class="col mb-2 align-items-center">
                                                <textarea id="description" name="description" rows="6" cols="10" class="form-control" placeholder="Descripción del examen" required></textarea>
                                            </div>
                                            <div class="col mb-2 align-items-start">
                                                <input type="date" id="startsAt" name="startsAt" class="form-control"/>
                                            </div>
                                            <div class="col mb-2 align-items-start">
                                                <input type="date" id="endsAt" name="endsAt" class="form-control"/>
                                            </div>
                                            <div class="col mb-2 align-items-start">
                                                <input type="text" id="subject" name="subject" class="form-control" placeholder="Asignatura" required>
                                            </div>
                                        </div>
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





