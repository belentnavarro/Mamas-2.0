<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author belentnavarro
 */
class Person {
    private $dni;
    private $name;
    private $surname;
    private $email;
    private $rol;
    private $password;
    private $profilePhoto;
    private $active;
    
    // Metodo constructor
    function __construct($dni, $name, $surname, $email, $password, $profilePhoto, $rol, $active) {
        $this->dni = $dni;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->profilePhoto = $profilePhoto;
        $this->rol = $rol;
        $this->active = $active;
    }
    
    // Métodos getter
    function getDni() {
        return $this->dni;
    }

    function getName() {
        return $this->name;
    }

    function getSurname() {
        return $this->surname;
    }

    function getEmail() {
        return $this->email;
    }

    function getRols() {
        return $this->rols;
    }

    function getPassword() {
        return $this->password;
    }

    function getProfilePhoto() {
        return $this->profilePhoto;
    }
    
    function getRol() {
        return $this->rol;
    }

    function getActive() {
        return $this->active;
    }

    // Métodos setter
    function setName($name) {
        $this->name = $name;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setRols($rols) {
        $this->rols = $rols;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setProfilePhoto($profilePhoto) {
        $this->profilePhoto = $profilePhoto;
    }

    function setActive($active) {
        $this->active = $active;
    }

    function setRol($rol): void {
        $this->rol = $rol;
    }

    // Método toString
    function __toString() {
        $cadena = 'Persona [DNI: '. $this->dni . ' Nombre: ' . $this->name . ' ' . $this->surname . '. Email: ' . $this->email . 
                'Foto de perfil: ' . $this->profilePhoto . '. Activo: ' . $this->active . ' Rol: ' . $this-rol;
        return $cadena;
    }
}
