<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Boton para cerrar la aplicación y la sesion
if (isset($_REQUEST['cerrar'])) {
    session_destroy();
    header("Location: ../index.php");
}