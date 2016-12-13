<?php

namespace AppBundle\Entity;

/**
 * Contrat
 */
class Contrat
{
    /**
     * @var int
     */
    private $idContrat;

    /**
     * @var float
     */
    private $tarif;

    /**
     * @var string
     */
    private $delai;

    /**
     * @var \Datetime
     */
    private $dateSign;

    /**
     * @var int
     */
    private $id_paiement;



    /**
     * Get id
     *
     * @return int
     */
    public function getIdContrat()
    {
        return $this->idContrat;
    }

    /**
     * Set tarif
     *
     * @param float $tarif
     *
     * @return Contrat
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return float
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set delai
     *
     * @param string $delai
     *
     * @return Contrat
     */
    public function setDelai($delai)
    {
        $this->delai = $delai;

        return $this;
    }

    /**
     * Get delai
     *
     * @return string
     */
    public function getDelai()
    {
        return $this->delai;
    }

    /**
     * Set dateSign
     * 
     * @param \Datetime $dateSign
     *
     * @return Contrat
     */
    public function setDateSign($dateSign)
    {
        $this->dateSign = $dateSign;

        return $this;
    }

    /**
     * Get dateSign
     *
     * @return \Datetime
     */
    public function getDateSign()
    {
        return $this->dateSign;
    }

    /**
     * Set id_paiement
     *
     * @param integer $id_paiement
     *
     * @return Contrat
     */
    public function setid_paiement($id_paiement)
    {
        $this->id_paiement = $id_paiement;

        return $this;
    }

    /**
     * Get id_paiement
     *
     * @return int
     */
    public function getid_paiement()
    {
        return $this->id_paiement;
    }
}

