<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Constantes
 *
 * @author belentnavarro
 */
class Constants {
    public static $DDBB = 'mamas-2_0'; // Nombre de la BBDD.
    public static $USER = 'luis'; // Usuario para acceder a ella.
    public static $PASSWORD = 'Chubaca2020'; // Contraseña para acceder a ella.
    
    public static $PEOPLE = 'people'; // Tabla con todos los datos de los usuarios de la aplicación.
    public static $ROLS = 'rols'; // Tabla con todos los roles de la aplicación.
    public static $PERSONROL = 'personRol'; // Tabla con la asignación de roles de los usuarios.
    public static $EXAMS = 'exams'; // Tabla con todos los exámenes de la aplicación
    public static $QUESTIONS = 'questions'; // Tabla para las preuntas
    public static $ANSWERS_NUMBERS = 'answers_numbers'; // Tabla para las preguntas tipo number
    public static $ANSWERS_TEXT = 'answers_texts'; // Tabla para las preguntas tipo text
    public static $EXAM_QUESTIONS = 'exam_questions'; // Tabla para guardar las preguntas de un examen
}
