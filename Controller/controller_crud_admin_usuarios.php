<?php

// Includes y requires
require_once '../Model/Person.php';
require_once '../Model/PersonDAO.php';

// Inicio sesion
session_start();

// Botón para añadir un usuario
if(isset($_REQUEST['add_user'])){
    // Recupero los datos del formulario
   $dni = $_REQUEST['dni'];
   $name = $_REQUEST['name'];
   $surname = $_REQUEST['surname'];
   $email = $_REQUEST['email'];
   $password = $_REQUEST['password'];
   $active = 0;
   $opc_rol = $_REQUEST['rol'];
   if($opc_rol == 'usuario'){
       $rol = 0;
   } else if ($opc_rol == 'profesor'){
       $rol = 1;
   } else if ($opc_rol == 'administrador'){
       $rol = 2;
   }
   $img_name = 'dAPG.png';
   
   // Compruebo que el email no este ya en la base de datos
   if(PersonDAO::existsPersonDni($dni) == $dni || PersonDAO::existsPersonEmail($email) == $email){
       // Guardo un mensaje de error cuando existe el usuario
       $_SESSION['mensaje'] = 'Ya existe un usuario con dichos datos.';
       
       // Envio a la página de gestor de usuarios
       header('Location: ../View/crud_admin_usuarios.php');
   } else {
       // Hago la insercción del usuario a la BDD
       PersonDAO::insertPerson($dni, $name, $surname, $email, $password, $profilePhoto, $rol, $active);
       
       // Hago la insercción del rol en la BDD
       PersonDAO::insertRol($rol, $dni);
       
       // Guardo un mensaje de acierto cuando se ha añadido al usuario
       $_SESSION['mensaje'] = 'Se ha añadido correctamente el usuario.';
       
       // Envio a la página de gestor de usuarios
       header('Location: ../View/crud_admin_usarios.php');
   }
}

// Botón para editar un usuario
if(isset($_REQUEST['edit_user'])){
    // Recupero los datos del formulario
    $name = $_REQUEST['name'];
    $surname = $_REQUEST['surname'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $opc_rol = $_REQUEST['rol'];
    if($opc_rol == 'usuario'){
        $rol = 0;
    } else if ($opc_rol == 'profesor'){
        $rol = 1;
    } else if ($opc_rol == 'administrador'){
        $rol = 2;
    }
}

// Botón para activar/inactivar un usuario
if(isset($_REQUEST['active_user'])){
    // Recupero el DNI del usuario 
    $dni = $_REQUEST['dni'];
    
    //Recupero la opción del usuario
    $opc_active = $_REQUEST['active_user'];
    
    // Si el valor de la opcion es active_user
    if($opc_active == 'active_user'){
        //Activamos el usuario
        PersonDAO::activePersonDni($dni, 1);
    
        // Si el valor de la opción es inactive_user
    } else if ($opc_active == 'inactive_user'){
        // Desactivamos al usuario
        PersonDAO::activePersonDni($dni, 0);
    }
    
    header('Location: ../View/crud_admin_usuarios.php');
}

// Botón para eliminar un usuario
if(isset($_REQUEST['delete_user'])){
    // Recupero el DNI del usuario
    $dni = $_REQUEST['dni'];
    
}