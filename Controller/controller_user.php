<?php

// Includes y requires
require_once '../Model/Person.php';
require_once '../Model/PersonDAO.php';

// Inicio sesion
session_start();

// Boton para modificar el perfil
if (isset($_REQUEST['update_profile'])) {
    $dni = $_SESSION['userDni'];
    $name = $_REQUEST['name'];
    $surname = $_REQUEST['surname'];
    $email = $_REQUEST['email'];
    $passwordNew = $_REQUEST['passwordNew'];
    $img_name = $_FILES['profile_img']['name'];

    //Recupero los datos del usuario
    $datJSON = PersonDAO::getPersonJSON($email);

    // Decodifico el JSON y saco el usuario del array
    $objs = json_decode($datJSON, true);
    $o = $objs[0];
    $user = new Person($o['dni'], $o['name'], $o['surname'], $o['email'], $o['password'], $o['profilePhoto'], $o['rol'], $o['active']);

    // Si el nombre de la imagen esta vacio no la modifico
    if ($img_name == '') {

        // Evaluo si ha modificado el password
        if ($passwordNew == '') {
            PersonDAO::updatePersonNoImgNoPass($name, $surname, $email, $dni);
        } else {
            $passwordE = password_hash($passwordNew, PASSWORD_DEFAULT);
            PersonDAO::updatePersonNoImgYesPass($name, $surname, $email, $passwordE, $dni);
        }
    } else {
        // Le añado la fecha al nombre del archivo
        $img_name = date('h-i-s') . $_FILES['profile_img']['name'];

        // Ruta para guardar las imagenes
        $img_directory = '../Img/img_profile_users/';

        // Muevo la imagen a la ruta
        move_uploaded_file($_FILES['profile_img']['tmp_name'], $img_directory . $img_name);
        // Evaluo si ha modificado el password
        if ($passwordNew == '') {
            PersonDAO::updatePersonImgNoPass($name, $surname, $email, $password, $img_name, $dni);
        } else {
            $passwordE = password_hash($passwordNew, PASSWORD_DEFAULT);
            PersonDAO::updatePersonImgYesPass($name, $surname, $email, $passwordE, $img_name, $dni);
        }
    }
    header("Location: ../View/ver_perfil.php");
}

