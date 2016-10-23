<?php

namespace freelancerppe\Domain;

class Contrat
{
    private $id_contrat;
    private $tarif;
    private $delai;
    private $date_sign;
    private $id_paiement;
    
    
    /* GETTERS */
    function getId_contrat() {
        return $this->id_contrat;
    }

    function getTarif() {
        return $this->tarif;
    }

    function getDelai() {
        return $this->delai;
    }

    function getDate_sign() {
        return $this->date_sign;
    }

    function getId_paiement() {
        return $this->id_paiement;
    }

        /* SETTERS */
        function setId_contrat($id_contrat) {
            $this->id_contrat = $id_contrat;
        }

        function setTarif($tarif) {
            $this->tarif = $tarif;
        }

        function setDelai($delai) {
            $this->delai = $delai;
        }

        function setDate_sign($date_sign) {
            $this->date_sign = $date_sign;
        }

        function setId_paiement($id_paiement) {
            $this->id_paiement = $id_paiement;
        }


}
