<?php

namespace freelancerppe\Domain;


class Test
{
    private $id_test;
    private $description;
    private $url_test;
    private $resultat;
    private $date_passage;
    private $id_freelancer;
    private $id_competence;
    
    /* GETTERS */
    
    function getId_test() {
        return $this->id_test;
    }

    function getDescription() {
        return $this->description;
    }

    function getUrl_test() {
        return $this->url_test;
    }

    function getResultat() {
        return $this->resultat;
    }

    function getDate_passage() {
        return $this->date_passage;
    }

    function getId_freelancer() {
        return $this->id_freelancer;
    }

    function getId_competence() {
        return $this->id_competence;
    }

    /* SETTERS */
    function setId_test($id_test) {
        $this->id_test = $id_test;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setUrl_test($url_test) {
        $this->url_test = $url_test;
    }

    function setResultat($resultat) {
        $this->resultat = $resultat;
    }

    function setDate_passage($date_passage) {
        $this->date_passage = $date_passage;
    }

    function setId_freelancer($id_freelancer) {
        $this->id_freelancer = $id_freelancer;
    }

    function setId_competence($id_competence) {
        $this->id_competence = $id_competence;
    }


}