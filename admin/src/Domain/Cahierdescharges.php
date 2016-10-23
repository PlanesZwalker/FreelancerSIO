<?php

namespace freelancerppe\Domain;

class Cahierdescharges
{
    private $id_cdc;
    private $tarif;
    private $delai;
    private $id_contrat; 
    
    
    /* GETTERS */
    
    function getId_cdc() {
        return $this->id_cdc;
    }

    function getTarif() {
        return $this->tarif;
    }

    function getDelai() {
        return $this->delai;
    }

    function getId_contrat() {
        return $this->id_contrat;
    }

    
    /* SETTERS */

    function setId_cdc($id_cdc) {
        $this->id_cdc = $id_cdc;
    }

    function setTarif($tarif) {
        $this->tarif = $tarif;
    }

    function setDelai($delai) {
        $this->delai = $delai;
    }

    function setId_contrat($id_contrat) {
        $this->id_contrat = $id_contrat;
    }


}
