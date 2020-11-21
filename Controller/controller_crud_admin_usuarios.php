<?php

// Includes y requires
require_once '../Model/Person.php';
require_once '../Model/PersonDAO.php';

// Inicio sesion
session_start();

// Botón para añadir un usuario
if(isset($_REQUEST['add_user'])){
    // Recupero los datos del formulario
   $dni = strtolower($_REQUEST['dni']);
   $name = strtolower($_REQUEST['name']);
   $surname = strtolower($_REQUEST['surname']);
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
   $profilePhoto = 'dAPG.png';
   
   // Compruebo que el email no este ya en la base de datos
   if(PersonDAO::existsPersonDni($dni) || PersonDAO::existsPersonEmail($email)){
       // Guardo un mensaje de error cuando existe el usuario
       $_SESSION['feedback-add-user'] = 'Ya existe un usuario con dichos datos.';
       
   } else {
       // Hago la insercción del usuario a la BDD
       PersonDAO::insertPerson($dni, $name, $surname, $email, $password, $profilePhoto, $rol, $active);
       
       // Hago la insercción del rol en la BDD
       PersonDAO::insertRol($rol, $dni);
       
       // Guardo un mensaje de acierto cuando se ha añadido al usuario
       $_SESSION['feedback-add-user'] = 'Se ha añadido correctamente el usuario.';
   }
   
    // Envio a la página de gestor de usuarios
    header('Location: ../View/crud_admin_usuarios.php');
}

// Botón para editar un usuario
if(isset($_REQUEST['edit_user'])){
    // Recupero los datos del formulario
    $dni = strtolower($_REQUEST['dni']);
    $name = strtolower($_REQUEST['name']);
    $surname = strtolower($_REQUEST['surname']);
    $email = strtolower($_REQUEST['email']);
    $password = $_REQUEST['password'];
    $opc_rol = $_REQUEST['rol'];
    if($opc_rol == 'usuario'){
        $rol = 0;
    } else if ($opc_rol == 'profesor'){
        $rol = 1;
    } else if ($opc_rol == 'administrador'){
        $rol = 2;
    }
    
    // Actualizo a la persona
    PersonDAO::updatePersonNoImg($name, $surname, $email, $password, $dni);
    
    // Actualizo el rol de la persona en la tabla personas
    PersonDAO::updateRolPerson($rol, $dni);
    
    // Actualizo el rol en la tabla de asignación de roles
    PersonDAO::updateRol($rol, $dni);
    
    // Guardo un mensaje de acierto cuando se ha editado al usuario
    $_SESSION['feedback-edit-user'] = 'Se ha editado correctamente al usuario.';
       
    // Envio a la página de gestor de usuarios
    header('Location: ../View/crud_admin_usuarios.php');
}

// Botón para activar/inactivar un usuario
if(isset($_REQUEST['active_user'])){
    // Recupero el DNI del usuario 
    $dni = strtolower($_REQUEST['dni']);
    
    //Recupero la opción del usuario
    $opc_active = $_REQUEST['active_user'];
    
    // Si el valor de la opcion es active_user
    if($opc_active == 'active_user'){
        //Activamos el usuario
        PersonDAO::activePersonDni($dni, 1);
        
        // Guardo un mensaje de acierto cuando se ha activado al usuario
        $_SESSION['feedback-active-user'] = 'Se ha activado correctamente al usuario.';
    
        // Si el valor de la opción es inactive_user
    } else if ($opc_active == 'inactive_user'){
        // Desactivamos al usuario
        PersonDAO::activePersonDni($dni, 0);
        
        // Guardo un mensaje de acierto cuando se ha activado al usuario
        $_SESSION['feedback-active-user'] = 'Se ha desactivado el usuario correctamente.';
    }
    
    // Envio a la página de gestor de usuarios
    header('Location: ../View/crud_admin_usuarios.php');
}

// Botón para eliminar un usuario
if(isset($_REQUEST['delete_user'])){
    // Recupero el DNI del usuario
    $dni = strtolower($_REQUEST['dni']);
    
    if(PersonDAO::existsPersonDni($dni)) {        
        // Borro el rol de la tabla de asignaciones
        PersonDAO::deleteRol($dni);
        
        // Borro a la persona
        PersonDAO::deletePerson($dni);
        
        // Guardo un mensaje de acierto cuando se ha añadido al usuario
       $_SESSION['feedback-delete-user'] = 'Se ha eliminado correctamente al usuario.';
    } else {
        // Guardo un mensaje de acierto cuando se ha añadido al usuario
       $_SESSION['feedback-delete-user'] = 'No se ha podido eliminar correctamente al usuario.';
    }
    
    // Envio a la página de gestor de usuarios
    header('Location: ../View/crud_admin_usuarios.php');
}