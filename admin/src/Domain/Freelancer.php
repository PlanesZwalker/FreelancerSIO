<?php

namespace freelancerppe\Domain;

class Freelancer extends User
{
    private $id_freelancer;
    private $url_cv;
    private $url_photo;
    private $age;
    private $id_user;
   
    
    /* GETTER */
    function getId_freelancer() {
        return $this->id_freelancer;
    }

    function getUrl_cv() {
        return $this->url_cv;
    }

    function getUrl_photo() {
        return $this->url_photo;
    }

    function getAge() {
        return $this->age;
    }

    function getId_user() {
        return $this->id_user;
    }

    
    
    /* SETTER */
    
    function setId_freelancer($id_freelancer) {
        $this->id_freelancer = $id_freelancer;
    }

    function setUrl_cv($url_cv) {
        $this->url_cv = $url_cv;
    }

    function setUrl_photo($url_photo) {
        $this->url_photo = $url_photo;
    }

    function setAge($age) {
        $this->age = $age;
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
