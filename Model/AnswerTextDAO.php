<?php

/**
 * Description of AnswerTextDAO
 *
 * @author luis
 */
// Includes y requieres
require_once 'GestionBDD.php';
require_once 'AnswerText.php';

class AnswerTextDAO {

    // Método para insertar una nueva respuesta
    static function insertAnswer($idQuestion, $correct, $content) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'INSERT INTO ' . Constants::$ANSWERS_TEXT . ' (questionId, correct, content) VALUES (?,?,?);';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("iis", $val1, $val2, $val3);

        // Valores de la sentencia
        $val1 = $idQuestion;
        $val2 = $correct;
        $val3 = strtolower($content);

        // Ejecuto y cierro la conexion
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }

// Método para recuperar todas preguntas
    static function getAllAnswerTJSON($questionId) {
        // Abro la conexión
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'SELECT * FROM ' . Constants::$ANSWERS_TEXT . ' WHERE questionId = ?;';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("i", $val1);

        // Valores de la sentencia
        $val1 = $questionId;

        // Variable para devolver las personas
        $questions = array();

        // Ejecuto y guardo el resultado
        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $questions[] = array('id' => $row['id'],
                'questionId' => $row['questionId'],
                'correct' => $row['correct'],
                'content' => $row['content']);
        }

        GestionBDD::cerrarBDD();

        // Codifico los datos en JSON
        $json_string = json_encode($questions);

        // Devuelvo los datos codificados
        return $json_string;
    }

}
