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
    private $rols;
    private $password;
    private $profilePhoto;
    private $registerDate;
    private $lastLogin;
    private $active;
    
    function __construct($dni, $nombre, $suername, $email, $password, $profilePhoto, $registerDate, $lastLogin, $active) {
        $this->dni = $dni;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->rols = array();
        $this->password = $password;
        $this->profilePhoto = $profilePhoto;
        $this->registerDate = $registerDate;
        $this->lastLogin = $lastLogin;
        $this->active = $active;
    }
    
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

    function getRegisterDate() {
        return $this->registerDate;
    }

    function getLastLogin() {
        return $this->lastLogin;
    }

    function getActive() {
        return $this->active;
    }

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

    function setRegisterDate($registerDate) {
        $this->registerDate = $registerDate;
    }

    function setLastLogin($lastLogin) {
        $this->lastLogin = $lastLogin;
    }

    function setActive($active) {
        $this->active = $active;
    }

    function addRol($rol){
        $this->rols[] = $rol;
    }
    
    function deleteRol($rol){
        foreach($this->rols as $pos => $aux){
            if($rol == $aux){
                unset($this->rols[$pos]);
            }
        }
    }
    
    function getTotalRols(){
        return count($this->rols);
    }
    
    function __toString() {
        $cadena = 'Persona [DNI: '. $dni . ' Nombre ' . $this->name . ' ' . $this->surname . '. Email: ' . $this->email . 
                'Foto de perfil: ' . $this->profilePhoto . 'Se registro el ' . $this->registerDate . ' y su último login fue: ' . $this->lastLogin . '. Activo: ' . $this->active . ' Roles:  \n';
        foreach($this->rols as $rol){
            $cadena = $cadena . ' - ' . $asignatura . '</br>';
        }
        
        return $cadena;
    }
}
