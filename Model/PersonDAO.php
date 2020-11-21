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
    static function login($email, $password) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Variable para controlar el login correcto
        $correcto = false;

        // Preparo la sentencia SQL
        $query = 'SELECT * FROM ' . Constants::$PEOPLE . ' WHERE email = ? AND password = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("ss", $val1, $val2);

        // Valores de la sentencia
        $val1 = $email;
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

    // Método para realizar el login
    static function loginHash($email, $password) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Variable para controlar el login correcto
        $correcto = false;

        // Preparo la sentencia SQL
        $query = 'SELECT email, password FROM ' . Constants::$PEOPLE . ' WHERE email = ?;';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("s", $val1);

        // Valores de la sentencia
        $val1 = $email;

        // Ejecuto y guardo el resultado
        $stmt->execute();
        $stmt->bind_result($email, $passwordE);
        $row = $stmt->fetch();

        // Si hay resultados y es correcta la comprobación devuelvo true
        if (!empty($row)) {
            if (password_verify($password, $row['passwordE'])) {
                $correcto = true;
            }
        }

        // Cierro la sentencia y la consulta
        $stmt->close();
        GestionBDD::cerrarBDD();

        // Devuelvo si es o no correcto el login
        return $correcto;
    }

    // Método para recuperar el dni
    static function getDni($email) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Variable para devolver el rol
        $userDni = null;

        // Preparo la sentencia SQL
        $query = "SELECT dni FROM  " . Constants::$PEOPLE . " WHERE email = ?";
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("s", $val1);

        // Valores de la sentencia
        $val1 = $email;

        // Ejecuto y guardo el resultado
        $stmt->execute();

        // Vincular las variables de resultados
        $stmt->bind_result($dni);

        // Devuelvo null o la persona que venga en la consulta
        while ($stmt->fetch()) {
            $userDni = $dni;
        }

        // Cierro la sentencia y la consulta
        $stmt->close();
        GestionBDD::cerrarBDD();

        // Devuelvo el rol o null
        return $userDni;
    }

    // Método para recuperar el dni
    static function getRol($dni) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Variable para devolver el rol
        $userRol = null;

        // Preparo la sentencia SQL
        $query = "SELECT rol FROM " . Constants::$PEOPLE . " WHERE dni = ?";
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("s", $val1);

        // Valores de la sentencia
        $val1 = $dni;

        // Ejecuto y guardo el resultado
        $stmt->execute();

        // Vincular las variables de resultados
        $stmt->bind_result($rol);

        // Devuelvo null o la persona que venga en la consulta
        while ($stmt->fetch()) {
            $userRol = $rol;
        }

        // Cierro la sentencia y la consulta
        $stmt->close();
        GestionBDD::cerrarBDD();

        // Devuelvo el rol o null
        return $userRol;
    }

    // Método para saber si existe un registro por el correo
    static function existsPersonEmail($email) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Variable para devolver valor
        $exists = false;

        // Preparo la sentencia SQL
        $query = 'SELECT * FROM ' . Constants::$PEOPLE . ' WHERE email = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("s", $val1);

        // Valores de la sentencia
        $val1 = $email;

        // Ejecuto y guardo el resultado
        $stmt->execute();
        $result = $stmt->get_result();

        // Devuelvo true o fase en funcion si trae o no filas la consulta
        if ($result->num_rows > 0) {
            $exists = true;
        }

        // Cierro la sentencia y la consulta
        $stmt->close();
        GestionBDD::cerrarBDD();
        // Develvo si existe o no
        return $exists;
    }

    // Método para saber si existe un registro por el correo
    static function existsPersonDni($dni) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Variable para devolver valor
        $exists = false;

        // Preparo la sentencia SQL
        $query = 'SELECT * FROM ' . Constants::$PEOPLE . ' WHERE dni = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("s", $val1);

        // Valores de la sentencia
        $val1 = $dni;

        // Ejecuto y guardo el resultado
        $stmt->execute();
        $result = $stmt->get_result();

        // Devuelvo true o fase en funcion si trae o no filas la consulta
        if ($result->num_rows > 0) {
            $exists = true;
        }

        // Cierro la sentencia y la consulta
        $stmt->close();
        GestionBDD::cerrarBDD();
        // Develvo si existe o no
        return $exists;
    }

    // Método para saber si un usuario esta activo
    static function isActivePersonDni($dni) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Variable para devolver valor
        $activeU;

        // Preparo la sentencia SQL
        $query = 'SELECT active FROM ' . Constants::$PEOPLE . ' WHERE dni = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("s", $val1);

        // Valores de la sentencia
        $val1 = $dni;

        // Ejecuto y guardo el resultado
        $stmt->execute();
        $stmt->bind_result($active);

        // Guardo el valor de la consulta
        if ($stmt->fetch()) {
            $activeU = $active;
        }

        // Cierro la sentencia y la consulta
        $stmt->close();
        GestionBDD::cerrarBDD();
        // Develvo si existe o no
        return $activeU;
    }

    // Metodo para activar o desactivar a un usuario
    static function activePersonDni($dni, $active) {
        // Abro la conexión
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'UPDATE ' . Constants::$PEOPLE . ' SET active = ? WHERE dni = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("is", $val1, $val2);

        // Valores de la sentencia
        $val1 = $active;
        $val2 = $dni;

        // Ejecuto y cierro la conexión
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }

    // Método para recuperar una persona de la BDD
    static function getPersonJSON($email) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'SELECT * FROM people WHERE email = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("s", $val1);

        // Valores de la sentencia
        $val1 = $email;

        // Creo una persona para devolver lo que venga en la consulta
        $person = array();

        // Ejecuto y guardo el resultado
        $stmt->execute();

        // Vincular las variables de resultados
        $stmt->bind_result($dni, $name, $surname, $email, $password, $profilePhoto, $rol, $active);

        if ($stmt->fetch()) {
            $person[0] = array(
                'dni' => $dni,
                'name' => $name,
                'surname' => $surname,
                'email' => $email,
                'password' => $password,
                'profilePhoto' => $profilePhoto,
                'rol' => $rol,
                'active' => $active,
            );
        }

        // Cierro la sentencia y la consulta
        $stmt->close();
        GestionBDD::cerrarBDD();

        // Devuelvo la persona o null y codifico en JSON 
        $json_string = json_encode($person);
        return $json_string;
    }

    // Método para recuperar todas las personas de la BD
    static function getAll() {
        // Abro la conexión
        GestionBDD::conectarBDD();

        // Variable para devolver las personas
        $people = array();

        // Preparo la sentencia SQL
        $query = 'SELECT * FROM ' . Constants::$PEOPLE;

        // Ejecuto y guardo el resultado
        if ($result = GestionBDD::$conexion->query($query)) {
            while ($row = $result->fetch_array()) {
                $people[] = new Person($row['dni'], $row['name'], $row['surname'], $row['email'], $row['password'], $row['profilePhoto'], $row['rol'], $row['active']);
            }

            // Libero el resultado
            $result->free();
        }

        GestionBDD::cerrarBDD();

        // Devuelvo los usuarios
        return $people;
    }

    // Método para recuperar todas las personas de la BD JSON
    static function getAllJSON() {
        // Abro la conexión
        GestionBDD::conectarBDD();

        // Variable para devolver las personas
        $people = array();

        // Preparo la consulta
        $query = 'SELECT * FROM ' . Constants::$PEOPLE;

        //Ejecuto y guardo el resultado
        if ($result = GestionBDD::$conexion->query($query)) {
            while ($row = $result->fetch_array()) {
                $people[] = array('dni' => $row['dni'],
                    'name' => $row['name'],
                    'surname' => $row['surname'],
                    'email' => $row['email'],
                    'password' => $row['password'],
                    'profilePhoto' => $row['profilePhoto'],
                    'rol' => $row['rol'],
                    'active' => $row['active']);
            }

            // Libero el resultado
            $result->free();
        }

        GestionBDD::cerrarBDD();

        // Codifico los datos en JSON
        $json_string = json_encode($people);

        // Devuelvo los datos codificados
        return $json_string;
    }

    // Método para insertar un nuevo registro
    static function insertPerson($dni, $name, $surname, $email, $password, $profilePhoto, $rol, $active) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'INSERT INTO ' . Constants::$PEOPLE . ' (dni, name, surname, email, password, profilePhoto, active, rol) VALUES (?,?,?,?,?,?,?,?);';
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
    
    // Metodo para eliminar un usuario
    static function deletePerson($dni){
        // Abro la conexion
        GestionBDD::conectarBDD();
        
        // Preparo la sentencia SQL
        $query = 'DELETE FROM ' . Constants::$PEOPLE . ' WHERE dni = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("s", $val1);
        
        // Valores de la sentencia
        $val1 = $dni;
        
        // Ejecuto y cierro la conexion
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }

    // Actualizo el password con el email
    static function updatePassEmail($newPass, $email) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = "UPDATE " . Constants::$PEOPLE . " SET password = ? WHERE email = ?";
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("ss", $val1, $val2);

        // Valores de la sentencia
        $val1 = $newPass;
        $val2 = $email;

        // Ejecuto y cierro la conexion
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }

    // Método para insertar un nuevo rol
    static function insertRol($idRol, $dniPerson) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'INSERT INTO ' . Constants::$PERSONROL . ' (idRol, dniPerson) VALUES (?,?);';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("ss", $val1, $val2);

        // Valores de la sentencia
        $val1 = $idRol;
        $val2 = strtolower($dniPerson);

        // Ejecuto y cierro la conexion
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }

    // Método para actualizar el rol
    static function updateRolPerson($idRol, $dniPerson) {
        // Abro la conexión
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'UPDATE ' . Constants::$PEOPLE . ' SET rol = ? WHERE dni = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("is", $val1, $val2);

        // Valores de la sentencia
        $val1 = $idRol;
        $val2 = $dniPerson;

        // Ejecuto y cierro la conexión
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }
    
    static function updateRol($idRol, $dniPerson){
        // Abro la conexión
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = 'UPDATE ' . Constants::$PERSONROL . ' SET idRol = ? WHERE dniPerson = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("is", $val1, $val2);

        // Valores de la sentencia
        $val1 = $idRol;
        $val2 = $dniPerson;

        // Ejecuto y cierro la conexión
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }
    
    // Método para borrar el rol del usuario
    static function deleteRol($dniPerson){
        // Abro la conexión
        GestionBDD::conectarBDD();
        
        // Preparo la sentencia SQL
        $query = 'DELETE FROM ' . Constants::$PERSONROL . ' WHERE dniPerson = ?';
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("s", $val1);
        
        // Valores de la sentencia
        $val1 = $dniPerson;

        // Ejecuto y cierro la conexión
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }

    // Actualiza el perfil del usuario desde el propio perfil, sin modificar la imagen de perfil
    static function updatePersonNoImg($name, $surname, $email, $password, $dni) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = "UPDATE " . Constants::$PEOPLE . " SET name = ?, surname = ?, email = ?, password = ? WHERE dni = ?";
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("sssss", $val1, $val2, $val3, $val4, $val5);

        // Valores de la sentencia
        $val1 = $name;
        $val2 = $surname;
        $val3 = $email;
        $val4 = $password;
        $val5 = $dni;

        // Ejecuto y cierro la conexion
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }
    
    // Actualiza el perfil del usuario desde el propio perfil, modificando la imagen de perfil
    static function updatePersonImg($name, $surname, $email, $password, $img_name, $dni) {
        // Abro la conexion
        GestionBDD::conectarBDD();

        // Preparo la sentencia SQL
        $query = "UPDATE " . Constants::$PEOPLE . " SET name = ?, surname = ?, email = ?, password = ?, profilePhoto = ? WHERE dni = ?";
        $stmt = GestionBDD::$conexion->prepare($query);
        $stmt->bind_param("ssssss", $val1, $val2, $val3, $val4, $val5, $val6);

        // Valores de la sentencia
        $val1 = $name;
        $val2 = $surname;
        $val3 = $email;
        $val4 = $password;
        $val5 = $img_name;
        $val6 = $dni;

        // Ejecuto y cierro la conexion
        $stmt->execute();
        GestionBDD::cerrarBDD();
    }

}
