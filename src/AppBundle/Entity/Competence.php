<?php

namespace AppBundle\Entity;

/**
 * Competence
 */
class Competence
{
    /**
     * @var int
     */
    private $idCompetence;

    /**
     * @var string
     */
    private $categorie;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $idFreelancer;


    /**
     * Get id
     *
     * @return int
     */
    public function getIdCompetence()
    {
        return $this->idCompetence;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Competence
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Competence
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
     * Set idFreelancer
     *
     * @param integer $idFreelancer
     *
     * @return Competence
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

