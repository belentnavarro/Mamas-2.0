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
    static function insertPerson($dni, $name, $surname, $email, $password, $profilePhoto) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'INSERT INTO people (dni, name, surname, email, password, profilePhoto) VALUES (?,?,?,?,?,?);';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("ssssss", $val1, $val2, $val3, $val4, $val5, $val6);

        // Valores de la sentencia
        $val1 = strtolower($dni);
        $val2 = strtolower($name);
        $val3 = strtolower($surname);
        $val4 = strtolower($email);
        $val5 = $password;
        $val6 = $profilePhoto;

        // Ejecuto y cierro la conexion
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }

}
