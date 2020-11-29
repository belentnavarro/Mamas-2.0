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
    static function getQuestionsAllJSON() {
        // Abro la conexión
        GestionBDD::conectarBDD();

        // Variable para devolver las personas
        $questions = array();

        // Preparo la consulta
        $query = 'SELECT * FROM ' . Constants::$QUESTIONS . ';';

        //Ejecuto y guardo el resultado
        if ($result = GestionBDD::$conexion->query($query)) {
            while ($row = $result->fetch_array()) {
                $question[] = array('id' => $row['id'],
                    'dniCreator' => $row['dniCreator'],
                    'type' => $row['type'],
                    'active' => $row['active'],
                    'content' => $row['content']);
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

    // Método para recuperar todas preguntas
    static function getQuestionsTypeJSON($typeQ) {
        // Abro la conexión
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'SELECT * FROM ' . Constants::$QUESTIONS . ' WHERE type = ?;';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("s", $val1);

        // Valores de la sentencia
        $val1 = $typeQ;

        // Variable para devolver las personas
        $questions = array();

        // Ejecuto y guardo el resultado
        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $questions[] = array('id' => $row['id'],
                'dniCreator' => $row['dniCreator'],
                'type' => $row['type'],
                'active' => $row['active'],
                'score' => $row['score'],
                'content' => $row['content']);
        }

        GestionBDD::cerrarBDD();

        // Codifico los datos en JSON
        $json_string = json_encode($questions);

        // Devuelvo los datos codificados
        return $json_string;
    }

    // Método para modificar una pregunta
    static function updateQuestion($idQuestion, $activeQuestion, $contentQuestion, $scoreQuestion) {
        // Abro la conexión
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'UPDATE ' . Constants::$QUESTIONS . ' SET active = ?, score = ?, content = ? WHERE id = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("iisi", $val1, $val2, $val3, $val4);

        // Valores de la sentencia
        $val1 = $activeQuestion;
        $val2 = $scoreQuestion;
        $val3 = $contentQuestion;
        $val4 = $idQuestion;

        // Ejecuto y cierro la conexión
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }
    

    // Metodo para eliminar una pregunta
    static function deleteQuestion($id) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'DELETE FROM ' . Constants::$QUESTIONS . ' WHERE id = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("i", $val1);

        // Valores de la sentencia
        $val1 = $id;

        // Ejecuto y cierro la conexion
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }

}
