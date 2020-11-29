<?php

// Includes y requires
require_once '../Model/Exam.php';
require_once '../Model/ExamDAO.php';

// Inicio sesion
session_start();

// Array para guardar las preguntas del examen
if(isset($_SESSION['examQuestions'])){
    $examQuestions = $_SESSION['examQuestions'];
} else {
    $examQuestions = array();
}

// Botón de añadir examen
if(isset($_REQUEST['create_exam'])){
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
    $id = ExamDAO::getIDLastInsertExam($dniCreator, $tittle);
    
    // Creo el examen y lo guardo en la sesión
    $exam = new Exam($id, $dniCreator, $tittle, 0, $startsAt, $endsAt, $description, $subject);
    $_SESSION['exam-created'] = $exam;
    
    // Envío a la página para añadir preguntas al examen
    header('Location: ../View/crud_add_questions_exam.php'); 
}

// Botón para añadir una nueva pregunta al examen
if(isset($_REQUEST['addQuestion'])){
    // Recupero el Id del pregunta
    $idQuestion = intval($_REQUEST['idQuestion']);
    $examQuestions[] = $idQuestion;
    $_SESSION['examQuestions'] = $examQuestions;
    header('Location: ../View/crud_create_exam.php');
}
