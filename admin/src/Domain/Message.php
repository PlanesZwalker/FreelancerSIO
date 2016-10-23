<?php

namespace freelancerppe\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class Message 
{
    private $id_message;
    private $id_admin;
    private $id_freelancer;
    private $id_societe;
    private $type;
    private $sujet;
    private $contenu;
    private $date;
    
    /* GETTERS */
    function getId_message() {
        return $this->id_message;
    }

    function getId_admin() {
        return $this->id_admin;
    }

    function getId_freelancer() {
        return $this->id_freelancer;
    }

    function getId_societe() {
        return $this->id_societe;
    }

    function getType() {
        return $this->type;
    }

    function getSujet() {
        return $this->sujet;
    }

    function getContenu() {
        return $this->contenu;
    }

    function getDate() {
        return $this->date;
    }

    /* SETTERS */
    
    function setId_message($id_message) {
        $this->id_message = $id_message;
    }

    function setId_admin($id_admin) {
        $this->id_admin = $id_admin;
    }

    function setId_freelancer($id_freelancer) {
        $this->id_freelancer = $id_freelancer;
    }

    function setId_societe($id_societe) {
        $this->id_societe = $id_societe;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setSujet($sujet) {
        $this->sujet = $sujet;
    }

    function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    function setDate($date) {
        $this->date = $date;
    }


}

