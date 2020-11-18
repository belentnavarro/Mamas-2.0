<?php

// Includes y requires
require_once '../Model/Person.php';
require_once '../Model/PersonDAO.php';

// Inicio sesion
session_start();

// Botón de login
if (isset($_REQUEST['login'])) {
    // Recupero los valores del login
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    // Guardo en la sesion el correo del usuario
    $_SESSION['userEmail'] = $email;
    print($email);
    print($password);
}

// Botón registro
if (isset($_REQUEST['register_user']) && isset($_POST['recaptchaResponse'])) {
    // Comprobación reCaptcha v3
    
    // Construyendo el POST request
    $recaptchaURL = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptchaSecret = '6LcSW-QZAAAAABa_tSTtujdCRfBChozuFcHhm1tq';
    $recaptchaResponse = $_POST['recaptchaResponse'];
    
    // Haciendo el requiest y decodoficándolo
    $recaptcha = file_get_contents($recaptchaURL . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
    $recaptcha = json_decode($recaptcha);
    
    // Verificación de que el usuario es humano
    if($recaptcha->success == true && $recaptcha->score >= 0.6){
        // Recupero los valores del login
        $dni = $_REQUEST['dni'];
        $name = $_REQUEST['name'];
        $surname = $_REQUEST['surname'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        // Recupero la imagen, comprobare por JS el type y el tamaño
        $img_name = date('h-i-s') . $_FILES['profile_img']['name'];
        $img_type = $_FILES['profile_img']['type'];
        $img_size = $_FILES['profile_img']['size'];

        // Ruta para guardar las imagenes
        $img_directory = '../Img/img_profile_users/';

        // Muevo la imagen a la ruta
        move_uploaded_file($_FILES['profile_img']['tmp_name'], $img_directory . $img_name);

        // Hago la insercción a la BDD
        PersonDAO::insertPerson($dni, $name, $surname, $email, $password, $img_name);

        // Envio a la pagina de usuario inactivo
        header('Location: ../View/usuario_inactivo.php');
    } else {
        $_SESSION['mensaje-captcha'] = 'Error al validar su identidad. ¿Es usted un robot?';
        header('Location: ../index.php');
    }

}

// Boton solicitar nueva contraseña
if (isset($_REQUEST['forgot_password'])) {
    // Recupero los valores del login
    $email = $_REQUEST['email'];
    print($email);
}
