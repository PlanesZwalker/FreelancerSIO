<?php

namespace MyFOSUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Messagefreelancer
 *
 * @ORM\Table(name="messagefreelancer", indexes={@ORM\Index(name="message", columns={"message"}), @ORM\Index(name="freelancer", columns={"freelancer"})})
 * @ORM\Entity
 */
class Messagefreelancer
{
    /**
     * @var \Freelancer
     *
     * @ORM\ManyToOne(targetEntity="Freelancer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="freelancer", referencedColumnName="id")
     * })
     */
    private $freelancer;

    /**
     * @var \Message
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Message")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="message", referencedColumnName="id_message")
     * })
     */
    private $message;


}

