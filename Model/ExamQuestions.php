<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExamQuestions
 *
 * @author luis
 */
class ExamQuestions {
    // Atributos de clase
    private $idExam;
    private $idQuestion;
    
    // Constructor
    function __construct($idExam, $idQuestion) {
        $this->idExam = $idExam;
        $this->idQuestion = $idQuestion;
    }

    // Getter
    function getIdExam() {
        return $this->idExam;
    }

    function getIdQuestion() {
        return $this->idQuestion;
    }

    // Setter
    function setIdExam($idExam): void {
        $this->idExam = $idExam;
    }

    function setIdQuestion($idQuestion): void {
        $this->idQuestion = $idQuestion;
    }

    public function __toString() {
        return 'Exam id: ' . $this->idExam . 'Question id: ' . $this->idQuestion;
    }

}
