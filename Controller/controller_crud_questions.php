<?php

// Includes y requires
require_once '../Model/Question.php';
require_once '../Model/QuestionDAO.php';
require_once '../Model/AnswerNumber.php';
require_once '../Model/AnswerNumberDAO.php';

// Inicio sesion
session_start();

// Boton nueva pregunta
if (isset($_REQUEST['addQuestion'])) {

    // Recupero los datos de la pregunta
    $type = $_REQUEST['typeQuestionAdd'];
    $active = intval($_REQUEST['activeQuestionAdd']);
    $score = intval($_REQUEST['scoreQuestionAdd']);
    $content = $_REQUEST['contentQuestionAdd'];
    
    // Recupero el dni del usuario
    $userDni = $_SESSION['userDni'];

    // Guardo la pregunta en la BDD
    QuestionDAO::insertQuestion($userDni, $type, $active, $score, $content);
    // Recupero el id de la pregunta insertada
    $idQuestion = QuestionDAO::getIdQuestion($userDni, $content);

    switch ($type) {
        case 'option':
            print('option');
            break;
        case 'writter':
            print('writter');
            break;
        case 'number':
            // Recupero los datos de la respuesta tipo numero
            $correct = 1; // La pregunta numérica siempre es la correcta, le paso 1
            $contentAnswerd = intval($_REQUEST['answerNumber']);
            AnswerNumberDAO::insertAnswer($idQuestion, $correct, $contentAnswerd);
            header('Location: ../View/crud_preguntas.php');
            break;
        default:
            break;
    }
}