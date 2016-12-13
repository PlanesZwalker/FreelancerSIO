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
    private $id_test;

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
    private $id_freelancer;

    /**
     * @var int
     */
    private $id_competence;


    /**
     * Get id
     *
     * @return int
     */
    public function getid_test()
    {
        return $this->id_test;
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
     * Set id_freelancer
     *
     * @param integer $id_freelancer
     *
     * @return Test
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
     * Set id_competence
     *
     * @param integer $id_competence
     *
     * @return Test
     */
    public function setid_competence($id_competence)
    {
        $this->id_competence = $id_competence;

        return $this;
    }

    /**
     * Get id_competence
     *
     * @return int
     */
    public function getid_competence()
    {
        return $this->id_competence;
    }
}

