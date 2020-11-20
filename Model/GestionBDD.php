<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GestionBDD
 *
 * @author belentnavarro
 */
// Includes y requires
require_once '../Auxiliar/Constants.php';

class GestionBDD {
    public static $conexion;
    
    public static function conectarBDD(){
        self::$conexion = new mysqli("localhost", Constants::$USER, Constants::$PASSWORD, Constants::$DDBB);
        
        if(mysqli_connect_errno(self::$conexion)){
            print "Fallo al conectar a MySQL: " . mysqli_connect_error();
        } else {
            //print "Conexión realizada con éxito.";
        }
    }
    
    public static function cerrarBDD(){
        self::$conexion->close();
    }
}

