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
    private $idPaiement;



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
     * Set idPaiement
     *
     * @param integer $idPaiement
     *
     * @return Contrat
     */
    public function setIdPaiement($idPaiement)
    {
        $this->idPaiement = $idPaiement;

        return $this;
    }

    /**
     * Get idPaiement
     *
     * @return int
     */
    public function getIdPaiement()
    {
        return $this->idPaiement;
    }
}

