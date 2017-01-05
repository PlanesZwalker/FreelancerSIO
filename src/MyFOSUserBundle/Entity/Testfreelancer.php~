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


}

