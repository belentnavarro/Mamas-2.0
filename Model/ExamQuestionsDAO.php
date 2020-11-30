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
}
