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
    private $id_competence;

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
    private $id_freelancer;


    /**
     * Get id
     *
     * @return int
     */
    public function getid_competence()
    {
        return $this->id_competence;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getdCompetence()
    {
        return $this->id_competence;
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
     * Set id_freelancer
     *
     * @param integer $id_freelancer
     *
     * @return Competence
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
    
    /**
     * Set id_freelancer
     *
     * @param integer $id_freelancer
     *
     * @return Competence
     */
    public function setIdFreelancer($id_freelancer)
    {
        $this->id_freelancer = $id_freelancer;

        return $this;
    }

    /**
     * Get id_freelancer
     *
     * @return int
     */
    public function getIdFreelancer()
    {
        return $this->id_freelancer;
    }
}

