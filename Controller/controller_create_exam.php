<?php

// Includes y requires
require_once '../Model/Exam.php';
require_once '../Model/ExamDAO.php';
require_once '../Model/QuestionDAO.php';
require_once '../Model/ExamQuestionsDAO.php';

// Inicio sesion
session_start();

// Array para guardar las preguntas del examen
if(isset($_SESSION['examQuestions'])){
    $examQuestions = $_SESSION['examQuestions'];
} else {
    $examQuestions = array();
}

// Variable para controlar el valor total del examen
if(isset($_SESSION['scoreExam'])){
    $scoreExam = $_SESSION['scoreExam'];
} else {
    $scoreExam = 0;
}

// Botón de añadir examen
if(isset($_REQUEST['createExam'])){
    // Recupero los valores del examen
    $tittle = $_REQUEST['tittle'];
    $description = $_REQUEST['description'];
    $startsAt = $_REQUEST['startsAt'];
    $endsAt = $_REQUEST['endsAt'];
    $subject = $_REQUEST['subject'];
    $dniCreator = $_SESSION['userDni'];

    
    // Inserto el examen en la BDD
    ExamDAO::insertExam($dniCreator, $tittle, $startsAt, $endsAt, $description, $subject);
    
    // Obtengo el id del último examen insertado
    $idExam = intval(ExamDAO::getIDLastInsertExam($dniCreator, $tittle));
    
    // Guardo las preguntas del examen
    foreach ($examQuestions as $question) {
        ExamQuestionsDAO::insertQuestionExam($idExam, $question);
    }
    
    // Borro los datos del examen de la sesion
    unset($scoreExam);
    unset($examQuestions);
    $_SESSION['scoreExam'] = $scoreExam;
    $_SESSION['examQuestions'] = $examQuestions;
    
    // Envío a la página para añadir preguntas al examen
    header('Location: ../View/crud_create_exam.php');
}

// Botón para añadir una nueva pregunta al examen
if(isset($_REQUEST['addQuestion'])){
    // Recupero el Id del pregunta
    $idQuestion = intval($_REQUEST['idQuestion']);
    // Guardo el id de la pregunta en el array del examen
    $examQuestions[] = $idQuestion;
    $_SESSION['examQuestions'] = $examQuestions;
    
    // Recupero el valor de la pregunta para calcular el total del examen
    $scoreExam = $_SESSION['scoreExam'];
    $scoreExam += QuestionDAO::getScoreQuestion($idQuestion);
    $_SESSION['scoreExam'] = $scoreExam;
    
    header('Location: ../View/crud_create_exam.php');
}

if(isset($_REQUEST['deleteQuestion'])){
    // Recupero el id de la pregunta a quitar del examen
    $idQuestion = intval($_REQUEST['deleteIdQuestion']);
    // Recuepro las preguntas del examen de la sesion
    $examQuestions = $_SESSION['examQuestions'];
    // Elimino la pregunta del array
    foreach ($examQuestions as $key => $value) {
        if($idQuestion == $value){
            unset($examQuestions[$key]);
        }
    }
    // Guardo las preguntas de nuevo en la sesion
    $_SESSION['examQuestions'] = $examQuestions;
    
    // Recalculo el valor total del examen
    $scoreExam = $_SESSION['scoreExam'];
    $scoreExam -= QuestionDAO::getScoreQuestion($idQuestion);
    $_SESSION['scoreExam'] = $scoreExam;
    
    header('Location: ../View/crud_create_exam.php');
}

// Boton para descartar un examen
if(isset($_REQUEST['deleteExam'])){
    unset($scoreExam);
    unset($examQuestions);
    $_SESSION['scoreExam'] = $scoreExam;
    $_SESSION['examQuestions'] = $examQuestions;
    header('Location: ../View/crud_create_exam.php');
}
