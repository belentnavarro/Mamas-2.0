<?php

/**
 * Description of QuestionDAO
 *
 * @author luis
 */

// Includes y requieres
require_once 'GestionBDD.php';
require_once 'Question.php';

class QuestionDAO {

    // Método para insertar una nueva pregunta
    static function insertQuestion($dniCreator, $type, $active, $score, $content) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'INSERT INTO ' . Constants::$QUESTIONS . ' (dniCreator, type, active, score, content) VALUES (?,?,?,?,?);';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("sssis", $val1, $val2, $val3, $val4, $val5);

        // Valores de la sentencia
        $val1 = strtolower($dniCreator);
        $val2 = strtolower($type);
        $val3 = strtolower($active);
        $val4 = $score;
        $val5 = strtolower($content);

        // Ejecuto y cierro la conexion
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }
    
    // Método para obtener el id de la pregunta que se acaba de insertar para relacionarla con las repuestas
        // Método para recuperar el dni
    static function getIdQuestion($dniCreator, $content) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Variable para devolver el rol
        $idQuestion = null;

        // Preparo la sentencia SQL
        $query = "SELECT id FROM  " . Constants::$QUESTIONS . " WHERE dniCreator = ? AND content = ?";
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("ss", $val1, $val2);

        // Valores de la sentencia
        $val1 = $dniCreator;
        $val2 = strtolower($content);

        // Ejecuto y guardo el resultado
        $stmt->execute();

        // Vincular las variables de resultados
        $stmt->bind_result($id);

        // Devuelvo null o el valor de la consulta
        if ($stmt->fetch()) {
            $idQuestion = $id;
        }

        // Cierro la sentencia y la consulta
        $stmt->close();
        GestionBDD::cerrarBDD();

        // Devuelvo el rol o null
        return $idQuestion;
    }
    
    // Método para recuperar todas preguntas
    static function getQuestionsNJSON() {
        // Abro la conexión
        GestionBDD::conectarBDD();

        // Variable para devolver las personas
        $questions = array();

        // Preparo la consulta
        $query = 'SELECT * FROM ' . Constants::$ANSWERS_NUMBERS;

        //Ejecuto y guardo el resultado
        if ($result = GestionBDD::$conexion->query($query)) {
            while ($row = $result->fetch_array()) {
                $question[] = array('id' => $row['id'],
                                    'dniCreator' => $row['dniCreator'],
                                    'type' => $row['active'],
                                    'active' => $row['active'],
                                    'content' => $row['conent']);
            }

            // Libero el resultado
            $result->free();
        }

        GestionBDD::cerrarBDD();

        // Codifico los datos en JSON
        $json_string = json_encode($questions);

        // Devuelvo los datos codificados
        return $json_string;
    }
}