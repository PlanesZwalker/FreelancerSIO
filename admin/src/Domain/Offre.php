<?php

namespace freelancerppe\Domain;

class Offre
{
    private $id_offre;
    private $tarif;
    private $delai;
    private $prop_commerciale;
    private $particularite;
    private $id_freelancer;
  
    
    /* GETTERS */
    function getId_offre() {
        return $this->id_offre;
    }

    function getTarif() {
        return $this->tarif;
    }

    function getDelai() {
        return $this->delai;
    }

    function getProp_commerciale() {
        return $this->prop_commerciale;
    }

    function getParticularite() {
        return $this->particularite;
    }

    function getId_freelancer() {
        return $this->id_freelancer;
    }

    
    
    /* SETTERS */
    function setId_offre($id_offre) {
        $this->id_offre = $id_offre;
    }

    function setTarif($tarif) {
        $this->tarif = $tarif;
    }

    function setDelai($delai) {
        $this->delai = $delai;
    }

    function setProp_commerciale($prop_commerciale) {
        $this->prop_commerciale = $prop_commerciale;
    }

    function setParticularite($particularite) {
        $this->particularite = $particularite;
    }

    function setId_freelancer($id_freelancer) {
        $this->id_freelancer = $id_freelancer;
    }


}
