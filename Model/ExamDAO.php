<?php

/**
 * Description of ExamDAO
 *
 * @author belentnavarro
 */

// Includes y requires
require_once 'GestionBDD.php';
require_once 'Exam.php';


class ExamDAO {
    // Método para insertar un examen
    static function insertExam($dniCreator, $tittle, $startsAt, $endsAt, $description, $subject){
        // Abro la conexión
        GestionBDD::conectarBDD();
        
        // Preparo la sentencia SQL
        $query = 'INSERT INTO ' . Constants::$EXAM . ' (dniCreator, tittle, startsAt, endsAt, description, subject) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param('ssssss', $val1, $val2, $val3, $val4, $val5, $val6);
        
        // Valores de la sentencia
        $val1 = strtolower($dniCreator);
        $val2 = strtolower($tittle);
        $val3 = $startsAt;
        $val4 = $endsAt;
        $val5 = $description;
        $val6 = strtolower($subject);
        
        // Ejecuto y cierro la conexión
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }
    
    // Método para recuperar el id del último examen insertado
    static function getIDLastInsertExam($dniCreator, $tittle){
        // Abro la conexión
        GestionBDD::conectarBDD();
        
        // Variable para devolver valor
        $idExam;
        
        // Preparo la sentencia SQL
        $query = "SELECT id FROM " . Constants::$EXAM . " WHERE id = (SELECT MAX(id) FROM " . Constants::$EXAM . ") AND dniCreator = ? AND tittle = ?";
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("ss", $val1, $val2);
        
        // Valores de la sentencia
        $val1 = strtolower($dniCreator);
        $val2 = strtolower($tittle);
        
        // Ejecuto y guardo el resultado
        $stmt->execute();
        $stmt->bind_result($id);
        
        // Guardo el valor de la consulta
        if($stmt->fetch()){
            $idExam = $id;
        }
        
        // Cierro la sentencia y la consulta
        $stmt->close();
        GestionBDD::cerrarBDD();
        
        // Devuelvo si existe o no
        return $id;        
    }
    
    // Método para recuperar todos los exámenes
    static function getAllJSON(){
        // Abro la conexión
        GestionBDD::conectarBDD();
        
        // Variable para devolver los exámenes
        $exams = array();
        
        // Preparo la consulta
        $query = 'SELECT * FROM ' . Constants::$EXAM;
        
        // Ejecuto y guardo el resultado
        if($result = GestionBDD::$conexion->query($query)){
            while($row = $result->fetch_array()){
                $exams[] = array('id' => $row['id'],
                    'dniCreator' => $row['dniCreator'],
                    'tittle' => $row['tittle'],
                    'description' => $row['description'],
                    'score' => $row['score'],
                    'startsAt' => $row['startsAt'],
                    'endsAt' => $row['endsAt'],
                    'subject' => $row['subject']);
            }
        }
        
        // Libero el resultado
        $result->free();
        
        // Cierro la conexión
        GestionBDD::cerrarBDD();
        
        // Codifico los datos en JSON
        $json_string = json_encode($exams);
        
        // Devuelvo los datos codificados
        return $json_string;
    }
    
    // Método para recuperar los exámenes según el DNI del creador
    static function getAllJSONByDNICreator($dniCreator){
        // Abro la conexión
        GestionBDD::conectarBDD();
        
        // Variable para devolver los exámenes
        $exams = array();
        
        // Preparo la consulta
        $query = 'SELECT * FROM ' . Constants::$EXAM . ' WHERE dniCreator = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("s", $val1);
        
        // Valores de la sentencia
        $val1 = $dniCreator;
        
        // Ejecuto y guardo el resultado
        $stmt->execute();
        if($result = $stmt->get_result()){
            while($row = $result->fetch_array()){
                $exams[] = array('id' => $row['id'],
                    'dniCreator' => $row['dniCreator'],
                    'tittle' => $row['tittle'],
                    'description' => $row['description'],
                    'score' => $row['score'],
                    'startsAt' => $row['startsAt'],
                    'endsAt' => $row['endsAt'],
                    'subject' => $row['subject']);
            }
        }
        
        // Libero el resultado
        $result->free();
        
        // Cierro la conexión
        GestionBDD::cerrarBDD();
        
        // Codifico los datos en JSON
        $json_string = json_encode($exams);
        
        // Devuelvo los datos codificados
        return $json_string;
    }
}
