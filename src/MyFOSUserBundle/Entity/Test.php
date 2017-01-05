<?php

namespace MyFOSUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity
 */
class Test
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_test", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTest;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=55, nullable=false)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="url_test", type="string", length=255, nullable=false)
     */
    private $urlTest;

    /**
     * @var string
     *
     * @ORM\Column(name="questionnaire", type="string", length=255, nullable=false)
     */
    private $questionnaire;



    /**
     * Get idTest
     *
     * @return integer
     */
    public function getIdTest()
    {
        return $this->idTest;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Test
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
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
     * Set questionnaire
     *
     * @param string $questionnaire
     *
     * @return Test
     */
    public function setQuestionnaire($questionnaire)
    {
        $this->questionnaire = $questionnaire;

        return $this;
    }

    /**
     * Get questionnaire
     *
     * @return string
     */
    public function getQuestionnaire()
    {
        return $this->questionnaire;
    }
}
