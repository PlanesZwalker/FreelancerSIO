<?php

namespace AppBundle\Entity;

/**
 * Paiement
 */
class Paiement
{
    /**
     * @var int
     */
    private $idPaiement;

    /**
     * @var string
     */
    private $etat;

    /**
     * @var string
     */
    private $dpSociete;

    /**
     * @var string
     */
    private $dpFreelancer;


    /**
     * Get id
     *
     * @return int
     */
    public function getIdPaiement()
    {
        return $this->idPaiement;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Paiement
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set dpSociete
     *
     * @param string $dpSociete
     *
     * @return Paiement
     */
    public function setDpSociete($dpSociete)
    {
        $this->dpSociete = $dpSociete;

        return $this;
    }

    /**
     * Get dpSociete
     *
     * @return string
     */
    public function getDpSociete()
    {
        return $this->dpSociete;
    }

    /**
     * Set dpFreelancer
     *
     * @param string $dpFreelancer
     *
     * @return Paiement
     */
    public function setDpFreelancer($dpFreelancer)
    {
        $this->dpFreelancer = $dpFreelancer;

        return $this;
    }

    /**
     * Get dpFreelancer
     *
     * @return string
     */
    public function getDpFreelancer()
    {
        return $this->dpFreelancer;
    }
}

