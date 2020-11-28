<?php

/**
 * Description of AnswerNumberDAO
 *
 * @author luis
 */
// Includes y requieres
require_once 'GestionBDD.php';
require_once 'AnswerNumber.php';

class AnswerNumberDAO {

    // Método para insertar una nueva pregunta
    static function insertAnswer($idQuestion, $correct, $content) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'INSERT INTO ' . Constants::$ANSWERS_NUMBERS . ' (questionId, correct, content) VALUES (?,?,?);';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("iii", $val1, $val2, $val3);

        // Valores de la sentencia
        $val1 = $idQuestion;
        $val2 = $correct;
        $val3 = $content;

        // Ejecuto y cierro la conexion
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }

    // Método para recuperar la respuesta numerica por el id de la pregunta
    static function getAnswerNJSON($questionId) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'SELECT * FROM ' . Constants::$ANSWERS_NUMBERS . ' WHERE questionId = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("i", $val1);

        // Valores de la sentencia
        $val1 = $questionId;

        // Creo una persona para devolver lo que venga en la consulta
        $answer = array();

        // Ejecuto y guardo el resultado
        $stmt->execute();

        // Vincular las variables de resultados
        $stmt->bind_result($id, $questionId, $correct, $content);

        if ($stmt->fetch()) {
            $answer[0] = array(
                'id' => $id,
                'questionId' => $questionId,
                'correct' => $correct,
                'content' => $content,
            );
        }

        // Cierro la sentencia y la consulta
        $stmt->close();
        GestionBDD::cerrarBDD();

        // Devuelvo la persona o null y codifico en JSON 
        $json_string = json_encode($answer);
        return $json_string;
    }

}
