<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

// Boton para cerrar la aplicación y la sesion
if (isset($_REQUEST['cerrar'])) {
    unset($scoreExam);
    unset($examQuestions);
    session_destroy();
    header("Location: ../index.php");
}