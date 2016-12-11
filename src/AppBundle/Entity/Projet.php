<?php

namespace AppBundle\Entity;

/**
 * Projet
 */
class Projet
{
    /**
     * @var int
     */
    private $idProjet;

    /**
     * @var float
     */
    private $prix;

    /**
     * @var int
     */
    private $etape;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $idSociete;

    /**
     * @var int
     */
    private $idCdc;


    /**
     * Get id
     *
     * @return int
     */
    public function getIdProjet()
    {
        return $this->idProjet;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Projet
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set etape
     *
     * @param integer $etape
     *
     * @return Projet
     */
    public function setEtape($etape)
    {
        $this->etape = $etape;

        return $this;
    }

    /**
     * Get etape
     *
     * @return int
     */
    public function getEtape()
    {
        return $this->etape;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Projet
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set idSociete
     *
     * @param integer $idSociete
     *
     * @return Projet
     */
    public function setIdSociete($idSociete)
    {
        $this->idSociete = $idSociete;

        return $this;
    }

    /**
     * Get idSociete
     *
     * @return int
     */
    public function getIdSociete()
    {
        return $this->idSociete;
    }

    /**
     * Set idCdc
     *
     * @param integer $idCdc
     *
     * @return Projet
     */
    public function setIdCdc($idCdc)
    {
        $this->idCdc = $idCdc;

        return $this;
    }

    /**
     * Get idCdc
     *
     * @return int
     */
    public function getIdCdc()
    {
        return $this->idCdc;
    }
}

