<?php

namespace MyFOSUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Testfreelancer
 *
 * @ORM\Table(name="testfreelancer", indexes={@ORM\Index(name="freelancer", columns={"freelancer"}), @ORM\Index(name="test", columns={"test"})})
 * @ORM\Entity
 */
class Testfreelancer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="resultat", type="integer", nullable=false)
     */
    private $resultat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_passage", type="datetime", nullable=false)
     */
    private $datePassage;

    /**
     * @var \Freelancer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Freelancer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="freelancer", referencedColumnName="id")
     * })
     */
    private $freelancer;

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
     * Set resultat
     *
     * @param integer $resultat
     *
     * @return Testfreelancer
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;

        return $this;
    }

    /**
     * Get resultat
     *
     * @return integer
     */
    public function getResultat()
    {
        return $this->resultat;
    }

    /**
     * Set datePassage
     *
     * @param \DateTime $datePassage
     *
     * @return Testfreelancer
     */
    public function setDatePassage($datePassage)
    {
        $this->datePassage = $datePassage;

        return $this;
    }

    /**
     * Get datePassage
     *
     * @return \DateTime
     */
    public function getDatePassage()
    {
        return $this->datePassage;
    }

    /**
     * Set freelancer
     *
     * @param \MyFOSUserBundle\Entity\Freelancer $freelancer
     *
     * @return Testfreelancer
     */
    public function setFreelancer(\MyFOSUserBundle\Entity\Freelancer $freelancer)
    {
        $this->freelancer = $freelancer;

        return $this;
    }

    /**
     * Get freelancer
     *
     * @return \MyFOSUserBundle\Entity\Freelancer
     */
    public function getFreelancer()
    {
        return $this->freelancer;
    }

    /**
     * Set test
     *
     * @param \MyFOSUserBundle\Entity\Test $test
     *
     * @return Testfreelancer
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
