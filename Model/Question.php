<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Question
 *
 * @author luis
 */
class Question {
    
    // Atributos de clase
    private $id;
    private $dniCreator;
    private $type;
    private $active;
    private $score;
    private $content;
    
    // Método contructor
    function __construct($id, $dniCreator, $type, $active, $score, $content) {
        $this->id = $id;
        $this->dniCreator = $dniCreator;
        $this->type = $type;
        $this->active = $active;
        $this->score = $score;
        $this->content = $content;
    }

    // Métodos getter
    function getId() {
        return $this->id;
    }

    function getDniCreator() {
        return $this->dniCreator;
    }

    function getType() {
        return $this->type;
    }

    function getActive() {
        return $this->active;
    }

    function getScore() {
        return $this->score;
    }
    
    function getContent() {
        return $this->content;
    }

    // Métodos setter
    function setId($id): void {
        $this->id = $id;
    }

    function setDniCreator($dniCreator): void {
        $this->dniCreator = $dniCreator;
    }

    function setType($type): void {
        $this->type = $type;
    }

    function setActive($active): void {
        $this->active = $active;
    }

    function setScore($score): void {
        $this->score = $score;
    }
    
    function setContent($content): void {
        $this->content = $content;
    }

    // toString
    public function __toString() {
        return 'Id: ' . $this->id . ', dniCreator: ' . $this->dniCreator . ', Type: ' . $this->type
            . ', Active: ' . $this->active . ', Score: ' . $this->score;
    }

}
