<?php

namespace freelancerppe\Domain;

class Societe extends User
{
    private $id_societe;  
    private $siret;
    private $denomination;
    private $description;
    private $id_user;
    
    
    /* GETTER  */
    
    function getId_societe() {
        return $this->id_societe;
    }

    function getSiret() {
        return $this->siret;
    }

    function getDenomination() {
        return $this->denomination;
    }

    function getDescription() {
        return $this->description;
    }

    function getId_user() {
        return $this->id_user;
    }

    
    /* SETTER */
    
    function setId_societe($id_societe) {
        $this->id_societe = $id_societe;
    }

    function setSiret($siret) {
        $this->siret = $siret;
    }

    function setDenomination($denomination) {
        $this->denomination = $denomination;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    

    /* METHODE DE LA CLASSE MERE USER */
    
    public function eraseCredentials() {
        parent::eraseCredentials();
    }

    public function getAdresse() {
        return parent::getAdresse();
    }

    public function getDate_insc() {
        return parent::getDate_insc();
    }

    public function getDate_modif() {
        return parent::getDate_modif();
    }

    public function getEmail() {
        return parent::getEmail();
    }

    public function getMotdepasse() {
        return parent::getMotdepasse();
    }

    public function getNomuser() {
        return parent::getNomuser();
    }

    public function getPassword() {
        return parent::getPassword();
    }

    public function getPrenomuser() {
        return parent::getPrenomuser();
    }

    public function getPseudo() {
        return parent::getPseudo();
    }

    public function getRole() {
        return parent::getRole();
    }

    public function getRoles() {
        parent::getRoles();
    }

    public function getSalt() {
        return parent::getSalt();
    }

    public function getStatut_connect() {
        return parent::getStatut_connect();
    }

    public function getTelephone() {
        return parent::getTelephone();
    }

    public function getUsername() {
        return parent::getUsername();
    }

    public function setAdresse($adresse) {
        parent::setAdresse($adresse);
    }

    public function setDate_insc($date_insc) {
        parent::setDate_insc($date_insc);
    }

    public function setDate_modif($date_modif) {
        parent::setDate_modif($date_modif);
    }

    public function setEmail($email) {
        parent::setEmail($email);
    }

    public function setMotdepasse($motdepasse) {
        parent::setMotdepasse($motdepasse);
    }

    public function setNomuser($nomuser) {
        parent::setNomuser($nomuser);
    }

    public function setPrenomuser($prenomuser) {
        parent::setPrenomuser($prenomuser);
    }

    public function setPseudo($pseudo) {
        parent::setPseudo($pseudo);
    }

    public function setRole($role) {
        parent::setRole($role);
    }

    public function setSalt($salt) {
        parent::setSalt($salt);
    }

    public function setStatut_connect($statut_connect) {
        parent::setStatut_connect($statut_connect);
    }

    public function setTelephone($telephone) {
        parent::setTelephone($telephone);
    }

}