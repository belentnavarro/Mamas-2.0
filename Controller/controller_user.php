<?php

// Includes y requires
require_once '../Model/Person.php';
require_once '../Model/PersonDAO.php';

// Inicio sesion
session_start();

// Boton para cerrar la aplicación y la sesion
if (isset($_REQUEST['update_profile'])) {
    $dni = $_SESSION['userDni'];
    $name = $_REQUEST['name'];
    $surname = $_REQUEST['surname'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $img_name = $_FILES['profile_img']['name'];

    // Si el nombre de la imagen esta vacio no la modifico
    if ($img_name == '') {
        PersonDAO::updatePersonNoImg($name, $surname, $email, $password, $dni);
    } else {
        // Le añado la fecha al nombre del archivo
        $img_name = date('h-i-s') . $_FILES['profile_img']['name'];
        
        // Ruta para guardar las imagenes
        $img_directory = '../Img/img_profile_users/';

        // Muevo la imagen a la ruta
        move_uploaded_file($_FILES['profile_img']['tmp_name'], $img_directory . $img_name);
        PersonDAO::updatePersonImg($name, $surname, $email, $password, $img_name, $dni);
    }
    header("Location: ../View/ver_perfil.php");
}

