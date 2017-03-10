<?php

namespace MyFOSUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Testcompetence
 *
 * @ORM\Table(name="testcompetence", indexes={@ORM\Index(name="test", columns={"test"}), @ORM\Index(name="competence", columns={"competence"})})
 * @ORM\Entity
 */
class Testcompetence
{
    /**
     * @var \Competence
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Competence")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="competence", referencedColumnName="id_competence")
     * })
     */
    private $competence;

    /**
     * @var \Test
     *
     * @ORM\ManyToOne(targetEntity="Test")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="test", referencedColumnName="id_test")
     * })
     */
    private $test;



    /**
     * Set competence
     *
     * @param \MyFOSUserBundle\Entity\Competence $competence
     *
     * @return Testcompetence
     */
    public function setCompetence(\MyFOSUserBundle\Entity\Competence $competence)
    {
        $this->competence = $competence;

        return $this;
    }

    /**
     * Get competence
     *
     * @return \MyFOSUserBundle\Entity\Competence
     */
    public function getCompetence()
    {
        return $this->competence;
    }

    /**
     * Set test
     *
     * @param \MyFOSUserBundle\Entity\Test $test
     *
     * @return Testcompetence
     */
    public function setTest(\MyFOSUserBundle\Entity\Test $test = null)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get test
     *
     * @return \MyFOSUserBundle\Entity\Test
     */
    public function getTest()
    {
        return $this->test;
    }
}