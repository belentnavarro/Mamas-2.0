<?php

/**
 * Description of PersonDAO
 *
 * @author Luis Quesada Romero
 */
// Includes y requieres
require_once 'GestionBDD.php';
require_once 'Person.php';

class PersonDAO {

    // Método para realizar el login
    static function login($correo, $password) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Variable para controlar el login correcto
        $correcto = false;

        // Preparo la sentencia SQL
        $query = 'SELECT * FROM people WHERE correo = ? AND password = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("ss", $val1, $val2);

        // Valores de la sentencia
        $val1 = $correo;
        $val2 = $password;

        // Ejecuto y guardo el resultado
        $stmt->execute();
        $result = $stmt->get_result();

        // Devuelvo true o fase en funcion si trae o no filas la consulta
        if ($result->num_rows > 0) {
            $correcto = true;
        }

        // Cierro la sentencia y la consulta
        $stmt->close();
        GestionBDD::cerrarBDD();

        // Devuelvo si es o no correcto el login
        return $correcto;
    }

    // Método para saber si existe un registro por el correo
    static function existsPerson($correo) {
        // Abro la conexion
        GestionBDD::nuevaConexcion();

        // Variable para devolver valor
        $existe = false;

        // Preparo la sentencia SQL
        $query = 'SELECT * FROM people WHERE correo = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("s", $val1);

        // Valores de la sentencia
        $val1 = $correo;

        // Ejecuto y guardo el resultado
        $stmt->execute();
        $result = $stmt->get_result();

        // Devuelvo true o fase en funcion si trae o no filas la consulta
        if ($result->num_rows > 0) {
            $existe = true;
        }

        // Cierro la sentencia y la consulta
        $stmt->close();
        GestionBDD::cerrarBDD();
        // Develvo si existe o no
        return $existe;
    }

    // Método para insertar un nuevo registro
    static function insertPerson($dni, $name, $surname, $email, $password, $profilePhoto, $rol, $active) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'INSERT INTO people (dni, name, surname, email, password, profilePhoto, active, rol) VALUES (?,?,?,?,?,?,?,?);';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("ssssssii", $val1, $val2, $val3, $val4, $val5, $val6, $val7, $val8);

        // Valores de la sentencia
        $val1 = strtolower($dni);
        $val2 = strtolower($name);
        $val3 = strtolower($surname);
        $val4 = strtolower($email);
        $val5 = $password;
        $val6 = $profilePhoto;
        $val7 = $active;
        $val8 = $rol;

        // Ejecuto y cierro la conexion
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }
    
    // Método para recuperar una persona de la BDD
    static function obtenerPersona($correo) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'SELECT * FROM people WHERE correo = ?';
        $stmt = self::$conexion->prepare($query);
        $stmt->bind_param("s", $val1);

        // Valores de la sentencia
        $val1 = $correo;

        // Creo una persona para devolver lo que venga en la consulta
        $persona = null;

        // Ejecuto y guardo el resultado
        $stmt->execute();

        // Vincular las variables de resultados
        $stmt->bind_result($dni, $name, $surname, $email, $password);

        // Devuelvo null o la persona que venga en la consulta
        if ($stmt->fetch()) {
            $persona = new Persona($nombre, $apellido, $correo, $password, $rol);
        }

        // Cierro la sentencia y la consulta
        $stmt->close();
        self::$conexion->close();

        // Devuelvo la persona o null
        return $persona;
    }
    

}
