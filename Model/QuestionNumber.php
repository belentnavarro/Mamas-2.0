<?php

/**
 * Description of QuestionText
 *
 * @author luis
 */

require_once 'Question.php';

class QuestionNumber extends Question {

    // Atributo
    private $content; // Tipo numero

    // Constructor
    function __construct($id, $dniCreator, $type, $active, $score, $content) {
        parent::__construct($id, $dniCreator, $type, $active, $score, $content);
        $this->content = $content;
    }

    // Getter
    function getContent() {
        return $this->content;
    }

    // Setter
    function setContent($content): void {
        $this->content = $content;
    }

    // Método para coregir
    public function correctQuestion() {
        // Corregira la pregunta
    }

    // toString
    public function __toString() {
        return parent::toString() . ', Contenido: ' . $this->contenido;
    }

}
