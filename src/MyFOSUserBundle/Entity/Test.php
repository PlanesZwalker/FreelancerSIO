<?php

namespace MyFOSUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test", indexes={@ORM\Index(name="id_competence", columns={"competence"})})
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
     * @var \Competence
     *
     * @ORM\ManyToOne(targetEntity="Competence")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="competence", referencedColumnName="id_competence")
     * })
     */
    private $competence;

    function getIdTest() {
        return $this->idTest;
    }

    function getIntitule() {
        return $this->intitule;
    }

    function getDescription() {
        return $this->description;
    }

    function getUrlTest() {
        return $this->urlTest;
    }

    function getQuestionnaire() {
        return $this->questionnaire;
    }

    function getCompetence() {
        return $this->competence;
    }

    function setIdTest($idTest) {
        $this->idTest = $idTest;
    }

    function setIntitule($intitule) {
        $this->intitule = $intitule;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setUrlTest($urlTest) {
        $this->urlTest = $urlTest;
    }

    function setQuestionnaire($questionnaire) {
        $this->questionnaire = $questionnaire;
    }

    function setCompetence(\Competence $competence) {
        $this->competence = $competence;
    }


}

