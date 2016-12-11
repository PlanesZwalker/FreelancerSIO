<?php

namespace AppBundle\Entity;

/**
 * Offre
 */
class Offre
{
    /**
     * @var int
     */
    private $idOffre;

    /**
     * @var float
     */
    private $tarif;

    /**
     * @var string
     */
    private $delai;

    /**
     * @var string
     */
    private $propCommerciale;

    /**
     * @var string
     */
    private $particularite;

    /**
     * @var int
     */
    private $idFreelancer;


    /**
     * Get id
     *
     * @return int
     */
    public function getIdOffre()
    {
        return $this->idOffre;
    }

    /**
     * Set tarif
     *
     * @param float $tarif
     *
     * @return Offre
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
     * @return Offre
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
     * Set propCommerciale
     *
     * @param string $propCommerciale
     *
     * @return Offre
     */
    public function setPropCommerciale($propCommerciale)
    {
        $this->propCommerciale = $propCommerciale;

        return $this;
    }

    /**
     * Get propCommerciale
     *
     * @return string
     */
    public function getPropCommerciale()
    {
        return $this->propCommerciale;
    }

    /**
     * Set particularite
     *
     * @param string $particularite
     *
     * @return Offre
     */
    public function setParticularite($particularite)
    {
        $this->particularite = $particularite;

        return $this;
    }

    /**
     * Get particularite
     *
     * @return string
     */
    public function getParticularite()
    {
        return $this->particularite;
    }

    /**
     * Set idFreelancer
     *
     * @param integer $idFreelancer
     *
     * @return Offre
     */
    public function setIdFreelancer($idFreelancer)
    {
        $this->idFreelancer = $idFreelancer;

        return $this;
    }

    /**
     * Get idFreelancer
     *
     * @return int
     */
    public function getIdFreelancer()
    {
        return $this->idFreelancer;
    }
}

