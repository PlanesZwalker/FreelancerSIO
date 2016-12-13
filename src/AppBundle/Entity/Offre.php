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
    private $id_offre;

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
    private $id_freelancer;


    /**
     * Get id
     *
     * @return int
     */
    public function getid_offre()
    {
        return $this->id_offre;
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
     * Set id_freelancer
     *
     * @param integer $id_freelancer
     *
     * @return Offre
     */
    public function setid_freelancer($id_freelancer)
    {
        $this->id_freelancer = $id_freelancer;

        return $this;
    }

    /**
     * Get id_freelancer
     *
     * @return int
     */
    public function getid_freelancer()
    {
        return $this->id_freelancer;
    }
}

