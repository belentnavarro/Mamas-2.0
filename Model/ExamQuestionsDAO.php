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
    
}
