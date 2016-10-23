<?php

namespace freelancerppe\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    private $id_user;
    private $pseudo;
    private $role;
    private $email;
    private $nomuser;
    private $prenomuser;
    private $adresse;
    private $telephone;
    private $motdepasse;
    private $salt;
    private $date_insc;
    private $date_modif;
    private $statut_connect;
    
   
    /* GETTER */
    function getId_user() {
        return $this->id_user;
    }

    function getPseudo() {
        return $this->pseudo;
    }

    function getRole() {
        return $this->role;
    }

    function getEmail() {
        return $this->email;
    }

    function getNomuser() {
        return $this->nomuser;
    }

    function getPrenomuser() {
        return $this->prenomuser;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function getTelephone() {
        return $this->telephone;
    }

    function getMotdepasse() {
        return $this->motdepasse;
    }

    function getSalt() {
        return $this->salt;
    }

    function getDate_insc() {
        return $this->date_insc;
    }

    function getDate_modif() {
        return $this->date_modif;
    }

    function getStatut_connect() {
        return $this->statut_connect;
    }

    
    /* SETTER */
    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    function setRole($role) {
        $this->role = $role;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setNomuser($nomuser) {
        $this->nomuser = $nomuser;
    }

    function setPrenomuser($prenomuser) {
        $this->prenomuser = $prenomuser;
    }

    function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    function setMotdepasse($motdepasse) {
        $this->motdepasse = $motdepasse;
    }

    function setSalt($salt) {
        $this->salt = $salt;
    }

    function setDate_insc($date_insc) {
        $this->date_insc = $date_insc;
    }

    function setDate_modif($date_modif) {
        $this->date_modif = $date_modif;
    }

    function setStatut_connect($statut_connect) {
        $this->statut_connect = $statut_connect;
    }


    /* ABSTRACT IMPLEMENTS METHODS */
    public function eraseCredentials() {
        
    }


    public function getRoles() {
        return array($this->getRole());
    }

    public function getUsername() {
         return $this->pseudo;
    }
    
    public function getPassword() {
        return $this->getMotdepasse();
    }




}

