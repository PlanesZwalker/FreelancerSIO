<?php

namespace AppBundle\Entity;

/**
 * Test
 */
class Test
{
    /**
     * @var int
     */
    private $idTest;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $urlTest;

    /**
     * @var string
     */
    private $resultat;

    /**
     * @var string
     */
    private $datePassage;

    /**
     * @var int
     */
    private $idFreelancer;

    /**
     * @var int
     */
    private $idCompetence;


    /**
     * Get id
     *
     * @return int
     */
    public function getIdTest()
    {
        return $this->idTest;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Test
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
     * Set urlTest
     *
     * @param string $urlTest
     *
     * @return Test
     */
    public function setUrlTest($urlTest)
    {
        $this->urlTest = $urlTest;

        return $this;
    }

    /**
     * Get urlTest
     *
     * @return string
     */
    public function getUrlTest()
    {
        return $this->urlTest;
    }

    /**
     * Set resultat
     *
     * @param string $resultat
     *
     * @return Test
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;

        return $this;
    }

    /**
     * Get resultat
     *
     * @return string
     */
    public function getResultat()
    {
        return $this->resultat;
    }

    /**
     * Set datePassage
     *
     * @param string $datePassage
     *
     * @return Test
     */
    public function setDatePassage($datePassage)
    {
        $this->datePassage = $datePassage;

        return $this;
    }

    /**
     * Get datePassage
     *
     * @return string
     */
    public function getDatePassage()
    {
        return $this->datePassage;
    }

    /**
     * Set idFreelancer
     *
     * @param integer $idFreelancer
     *
     * @return Test
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

    /**
     * Set idCompetence
     *
     * @param integer $idCompetence
     *
     * @return Test
     */
    public function setIdCompetence($idCompetence)
    {
        $this->idCompetence = $idCompetence;

        return $this;
    }

    /**
     * Get idCompetence
     *
     * @return int
     */
    public function getIdCompetence()
    {
        return $this->idCompetence;
    }
}

