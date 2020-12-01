<?php

/**
 * Description of examQuestions
 *
 * @author luis
 */
class ExamQuestionsDAO {
    // Método para insertar las respuestas del examen
    static function insertQuestionExam($idExam, $idQuestion){
        // Abro la conexión
        GestionBDD::conectarBDD();
        
        // Preparo la sentencia SQL
        $query = 'INSERT INTO ' . Constants::$EXAM_QUESTIONS . ' (idExam, idQuestion) VALUES (?, ?)';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param('ii', $val1, $val2);
        
        // Valores de la sentencia
        $val1 = strtolower($idExam);
        $val2 = strtolower($idQuestion);
        
        // Ejecuto y cierro la conexión
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }
    
    // Metodo para eliminar las preguntas de un examen
    static function deleteQuestionsExam($id) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'DELETE FROM ' . Constants::$EXAM_QUESTIONS . ' WHERE idExam = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("i", $val1);

        // Valores de la sentencia
        $val1 = $id;

        // Ejecuto y cierro la conexion
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }
    
    // Método para recuperar los exámenes según el DNI del creador
    static function getAllQuestionExam($idExam) {
        // Abro la conexión
        GestionBDD::conectarBDD();

        // Variable para devolver los exámenes
        $questionsExam = array();

        // Preparo la consulta
        $query = 'SELECT * FROM ' . Constants::$EXAM_QUESTIONS . ' WHERE idExam = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("i", $val1);

        // Valores de la sentencia
        $val1 = $idExam;

        // Ejecuto y guardo el resultado
        $stmt->execute();
        if ($result = $stmt->get_result()) {
            while ($row = $result->fetch_array()) {
                $questionsExam[] = array('idExam' => $row['idExam'],
                    'idQuestion' => $row['idQuestion']);
            }
        }

        // Libero el resultado
        $result->free();

        // Cierro la conexión
        GestionBDD::cerrarBDD();

        // Codifico los datos en JSON
        $json_string = json_encode($questionsExam);

        // Devuelvo los datos codificados
        return $json_string;
    }
    
    
}
