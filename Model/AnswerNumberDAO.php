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
}
