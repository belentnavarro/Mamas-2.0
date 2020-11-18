<?php

// Includes y requires
require_once '../Model/Person.php';
require_once '../Model/PersonDAO.php';

// Inicio sesion
session_start();

// Botón de login
if (isset($_REQUEST['login'])) {
    // Recupero los valores del login
    $correo = $_REQUEST['correo'];
    $password = $_REQUEST['password'];
    // Guardo en la sesion el correo del usuario
    $_SESSION['correoUsuario'] = $correo;

    if (GestionBDD::login($correo, $password)) {
        // Rescatamos el rol de usuario para guardarlo
        $rol = GestionBDD::obtenerRol($correo);
        // Guardo el rol en la sesion
        $_SESSION['rolUsuario'] = $rol;
        header('Location: ../vistas/tareas.php');
    } else {
        header('Location: ../vistas/error_login.php');
    }
}

// Botón registro
if (isset($_REQUEST['register_user'])) {
    // Recupero los valores del login
    $dni = $_REQUEST['dni'];
    $name = $_REQUEST['name'];
    $surname = $_REQUEST['surname'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $rol = 0;
    $active = 0;

    // Recupero la imagen, comprobare por JS el type y el tamaño
    $img_name = date('h-i-s') . $_FILES['profile_img']['name'];
    $img_type = $_FILES['profile_img']['type'];
    $img_size = $_FILES['profile_img']['size'];

    // Ruta para guardar las imagenes
    $img_directory = '../Img/img_profile_users/';

    // Muevo la imagen a la ruta
    move_uploaded_file($_FILES['profile_img']['tmp_name'], $img_directory . $img_name);
    
    // Hago la insercción a la BDD
    PersonDAO::insertPerson($dni, $name, $surname, $email, $password, $img_name, $rol, $active);
    
    // Envio a la pagina de usuario inactivo
    header('Location: ../View/usuario_inactivo.php');

}

// Boton solicitar nueva contraseña
if (isset($_REQUEST['forgot_password'])) {
    // Recupero los valores del login
    $email = $_REQUEST['email'];
    print($email);
}
