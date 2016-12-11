<?php

namespace AppBundle\Entity;

/**
 * Cahierdescharges
 */
class Cahierdescharges
{
    /**
     * @var int
     */
    private $idCdc;

    /**
     * @var float
     */
    private $tarif;

    /**
     * @var string
     */
    private $delai;

    /**
     * @var int
     */
    private $idContrat;


    /**
     * Get id
     *
     * @return int
     */
    public function getIdCdc()
    {
        return $this->idCdc;
    }

    /**
     * Set tarif
     *
     * @param float $tarif
     *
     * @return Cahierdescharges
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
     * @return Cahierdescharges
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
     * Set idContrat
     *
     * @param integer $idContrat
     *
     * @return Cahierdescharges
     */
    public function setIdContrat($idContrat)
    {
        $this->idContrat = $idContrat;

        return $this;
    }

    /**
     * Get idContrat
     *
     * @return int
     */
    public function getIdContrat()
    {
        return $this->idContrat;
    }
}

