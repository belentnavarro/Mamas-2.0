<?php

// Includes y requires
require_once '../Model/Question.php';
require_once '../Model/QuestionDAO.php';
require_once '../Model/AnswerNumber.php';
require_once '../Model/AnswerNumberDAO.php';
require_once '../Model/AnswerText.php';
require_once '../Model/AnswerTextDAO.php';

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
            // Recupero los valores de las respuestas y si son correctas o no
            $answerOption = $_REQUEST['answerOption'];
            $answerCorrect = $_REQUEST['answerCorrect'];
            // Guardo las respuestas en la tabla, pero filtro para introducir vacias
            for ($i = 0; $i < count($answerOption); $i++) {
                if (!empty($answerOption[$i])) {
                    AnswerTextDAO::insertAnswer($idQuestion, intval($answerCorrect[$i]), $answerOption[$i]);
                }
            }
            header('Location: ../View/crud_preguntas.php');
            break;
        case 'writter':
            // Recupero los valores de las respuestas, en este caso las palabras definidas por el profesor son correctas
            $answerOption = $_REQUEST['answerOption'];
            $answerCorrect = 1;
            // Guardo las respuestas en la tabla, pero filtro para introducir vacias
            for ($i = 0; $i < count($answerOption); $i++) {
                if (!empty($answerOption[$i])) {
                    AnswerTextDAO::insertAnswer($idQuestion, intval($answerCorrect), $answerOption[$i]);
                }
            }
            header('Location: ../View/crud_preguntas.php');
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

// Boton modificar pregunta tipo numero
if (isset($_REQUEST['updateQuestionNumber'])) {
    // Recuperos datos de la pregunta
    $activeQuestion = intval($_REQUEST['activeQuestionNumber']);
    $scoreQuestion = intval($_REQUEST['scoreQuestionNumber']);
    $contentQuestion = $_REQUEST['contentQuestionNumber'];
    $idQuestion = intval($_REQUEST['idQuestion']);
    // Modifico la pregunta
    QuestionDAO::updateQuestion($idQuestion, $activeQuestion, $contentQuestion, $scoreQuestion);

    // Recupero la respuesta
    $idAnswer = intval($_REQUEST['idAnswer']);
    $answerNumber = intval($_REQUEST['answerNumber']);
    // Modifico la respuesta
    AnswerNumberDAO::updateAnswer($idAnswer, $answerNumber);

    header('Location: ../View/crud_preguntas.php');
}

// Boton borrar pregunta tipo numero
if (isset($_REQUEST['deleteQuestionNumber'])) {
    // Recupero el Id de la pregunta y de la respuesta a borrar
    $idQuestion = intval($_REQUEST['idQuestion']);
    $idAnswer = intval($_REQUEST['idAnswer']);

    // Borro la pregunta y la respuesta
    AnswerNumberDAO::deleteAnswerNumber($idAnswer);
    QuestionDAO::deleteQuestion($idQuestion);

    header('Location: ../View/crud_preguntas.php');
}

// Modificar pregunta tipo opciones
if (isset($_REQUEST['updateQuestionOption'])) {
    // Recuperos datos de la pregunta
    $activeQuestion = intval($_REQUEST['activeQuestionOption']);
    $scoreQuestion = intval($_REQUEST['scoreQuestionOption']);
    $contentQuestion = $_REQUEST['contentQuestionOption'];
    $idQuestion = intval($_REQUEST['idQuestion']);
    // Modifico la pregunta
    QuestionDAO::updateQuestion($idQuestion, $activeQuestion, $contentQuestion, $scoreQuestion);

    // Borro las resputas por la id de pregunta para añadir las nuevas
    AnswerTextDAO::deleteAnswers($idQuestion);

    // Guado las nuevas respuestas en la bdd
    $answerOption = $_REQUEST['answerOption'];
    $answerCorrect = $_REQUEST['answerCorrect'];
    // Guardo las respuestas en la tabla, pero filtro para introducir vacias
    for ($i = 0; $i < count($answerOption); $i++) {
        if (!empty($answerOption[$i])) {
            AnswerTextDAO::insertAnswer($idQuestion, intval($answerCorrect[$i]), $answerOption[$i]);
        }
    }
    header('Location: ../View/crud_preguntas.php');

    header('Location: ../View/crud_preguntas.php');
}
