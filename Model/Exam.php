<?php

class Exam {

    // Variables de la clase
    private $id;
    private $dniCreator;
    private $tittle;
    private $score;
    private $startsAt;
    private $endsAt;
    private $description;
    private $subject;

    // Método constructor
    function __construct($id, $dniCreator, $tittle, $score, $startsAt, $endsAt, $description, $subject) {
        $this->id = $id;
        $this->dniCreator = $dniCreator;
        $this->tittle = $tittle;
        $this->score = $score;
        $this->startsAt = $startsAt;
        $this->endsAt = $endsAt;
        $this->description = $description;
        $this->subject = $subject;
    }

    // Métodos getter
    function getId() {
        return $this->id;
    }

    function getDniCreator() {
        return $this->dniCreator;
    }

    function getTittle() {
        return $this->tittle;
    }

    function getScore() {
        return $this->score;
    }

    function getStartsAt() {
        return $this->startsAt;
    }

    function getEndsAt() {
        return $this->endsAt;
    }

    function getDescription() {
        return $this->description;
    }
    
    function getSubject() {
        return $this->subject;
    }

    // Métodos setter
    function setTittle($tittle) {
        $this->tittle = $tittle;
    }

    function setScore($score) {
        $this->score = $score;
    }

    function setStartsAt($startsAt) {
        $this->startsAt = $startsAt;
    }

    function setEndsAt($endsAt) {
        $this->endsAt = $endsAt;
    }

    function setDescription($description) {
        $this->description = $description;
    }
    
    function setSubject($subject){
        $this->subject = $subject;
    }

    // Método para mostrar el examen
    public function __toString() {
        return 'Examen [ID: ' . $this->id . ', dniCreator = ' . $this->dniCreator . ', Tittle = ' . $this->tittle . ', StartsAt: ' . $this->startsAt . ', EndsAt: ' . $this->endsAt . ' Description = ' . $this->description . ', Subject= ' . $this->subject . ']';
    }
    
    // Métodos públicos de examen
    
    // Método para añadir una pregunta al examen
    public function addQuestion($question){
        
    }
    
    // Método para borrar una pregunta del examen
    public function deleteQuestion($question){
        
    }

}
