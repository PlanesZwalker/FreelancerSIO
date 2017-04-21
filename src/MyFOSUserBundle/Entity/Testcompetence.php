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


}

