<?php

/**
 * Description of QuestionText
 *
 * @author luis
 */


class QuestionNumber {

    // Atributo
    private $id;
    private $idQuestion;
    private $correct;
    private $content; // Tipo numero

    // Método constructor
    function __construct($id, $idQuestion, $correct, $content) {
        $this->id = $id;
        $this->idQuestion = $idQuestion;
        $this->correct = $correct;
        $this->content = $content;
    }

    // Getter
    function getId() {
        return $this->id;
    }

    function getIdQuestion() {
        return $this->idQuestion;
    }

    function getCorrect() {
        return $this->correct;
    }

    function getContent() {
        return $this->content;
    }

    // Métodos setter
    function setId($id): void {
        $this->id = $id;
    }

    function setIdQuestion($idQuestion): void {
        $this->idQuestion = $idQuestion;
    }

    function setCorrect($correct): void {
        $this->correct = $correct;
    }

    function setContent($content): void {
        $this->content = $content;
    }
    
}
