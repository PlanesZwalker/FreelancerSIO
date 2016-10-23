<?php

namespace freelancerppe\Domain;

class Competence
{
    private $id_competence;
    private $categorie;
    private $description;
    private $id_freelancer; 
  
    /* GETTERS */
    
    function getId_competence() {
        return $this->id_competence;
    }

    function getCategorie() {
        return $this->categorie;
    }

    function getDescription() {
        return $this->description;
    }

    function getId_freelancer() {
        return $this->id_freelancer;
    }


    /* SETTERS */
    
    function setId_competence($id_competence) {
        $this->id_competence = $id_competence;
    }

    function setCategorie($categorie) {
        $this->categorie = $categorie;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setId_freelancer($id_freelancer) {
        $this->id_freelancer = $id_freelancer;
    }


}
