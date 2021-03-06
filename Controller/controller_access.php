<?php

// Includes y requires
require_once '../Model/Person.php';
require_once '../Model/PersonDAO.php';
require_once '../PHPMailer/SendEmail.php';

// Inicio sesion
session_start();

// Botón de login
if (isset($_REQUEST['login'])) {
    // Comprobación reCaptcha v3
    // Construyendo el POST request
    $recaptchaURL = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptchaSecret = '6LchkOQZAAAAAG2wQ5HML903c3RT6pEXfwSO9zHz';
    $recaptchaResponse = $_POST['recaptchaResponse'];

    // Haciendo el requiest y decodoficándolo
    $recaptcha = file_get_contents($recaptchaURL . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
    $recaptcha = json_decode($recaptcha);

    // Verificación de que el usuario es humano
    if ($recaptcha->success == true && $recaptcha->score >= 0.6) {
        // Recupero los valores del login
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        // Guardo en la sesion el correo del usuario
        $_SESSION['userEmail'] = $email;

        // Compruebo login correcto
        if (PersonDAO::loginHash($email, $password)) {

            // Compruebo si el usuario esta inactivo
            $userDni = PersonDAO::getDni($email);
            if (PersonDAO::isActivePersonDni($userDni) == 0) {
                header('Location: ../View/usuario_inactivo.php');
            } else {
                // Guardo el dni en la sesion
                $_SESSION['userDni'] = $userDni;
                // Guardo el rol en la sesion
                $_SESSION['userRol'] = PersonDAO::getRol($userDni);
                header('Location: ../View/home.php');
            }
        } else {
            header('Location: ../View/login_incorrecto.php');
        }
    } else {
        // Captcha inválido
        $_SESSION['mensaje-captcha'] = 'Error al validar su identidad. ¿Es usted un robot?';

        // Envio a la página de inicio con mensaaje de error
        header('Location: ../index.php');
    }
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
    if ($recaptcha->success == true && $recaptcha->score >= 0.6) {
        // Recupero los valores del login
        $dni = $_REQUEST['dni'];
        $name = $_REQUEST['name'];
        $surname = $_REQUEST['surname'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        // Encripto la contraseña
        $passwordE = password_hash($password, PASSWORD_DEFAULT);
        $rol = 0;
        $active = 0;
        // Datos de la imagen
        $img_name;
        $img_type;
        $img_size;

        // Sino sube una imagen, le pongo una por defecto
        if ($_FILES['profile_img']['name'] == '') {
            $img_name = "dAPG.png";
        } else {
            // Recupero la imagen, comprobare por JS el type y el tamaño
            $img_name = date('h-i-s') . $_FILES['profile_img']['name'];
            $img_type = $_FILES['profile_img']['type'];
            $img_size = $_FILES['profile_img']['size'];

            // Ruta para guardar las imagenes
            $img_directory = '../Img/img_profile_users/';

            // Muevo la imagen a la ruta
            move_uploaded_file($_FILES['profile_img']['tmp_name'], $img_directory . $img_name);
        }

        // Compruebo que el email no este ya en la base de datos
        if(PersonDAO::existsPersonEmail($email) == $email || PersonDAO::existsPersonDni($dni) == $dni) {
            header('Location: ../View/error_registro.php');
        } else {
            // Hago la insercción a la BDD con el passwordE encriptado
            PersonDAO::insertPerson($dni, $name, $surname, $email, $passwordE, $img_name, $rol, $active);

            // Le doy el rol de usuario por defecto
            PersonDAO::insertRol(0, $dni);

            // Envio a la pagina de usuario inactivo
            header('Location: ../View/exito_registro.php');
        }
    } else {
        // Captcha inválido
        $_SESSION['mensaje-captcha'] = 'Error al validar su identidad. ¿Es usted un robot?';

        // Envio a la página de inicio con mensaaje de error
        header('Location: ../index.php');
    }
}

// Boton solicitar nueva contraseña
if (isset($_REQUEST['forgot_password'])) {
    // Recupero lo datos del formulario
    $email = $_REQUEST['email'];

    // Comprueba el correo para ver si el usuario esta registrado
    if (PersonDAO::existsPersonEmail($email)) {
        // Si existe creo una nueva
        $newPass = Person::newPass();
        $passwordE = password_hash($newPass, PASSWORD_DEFAULT);
        // Modifico la nueva contraseña en la base de datos
        PersonDAO::updatePassEmail($passwordE, $email);
        SendEmail::newEmail($email, $newPass);
    }
    // Muestro existo tanto este registrado o no, por motivos de seguridad
    header('Location: ../View/exito_password_enviado.php');
}