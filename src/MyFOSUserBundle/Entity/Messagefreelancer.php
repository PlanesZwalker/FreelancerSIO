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



    /**
     * Set freelancer
     *
     * @param \MyFOSUserBundle\Entity\Freelancer $freelancer
     *
     * @return Messagefreelancer
     */
    public function setFreelancer(\MyFOSUserBundle\Entity\Freelancer $freelancer = null)
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
     * Set message
     *
     * @param \MyFOSUserBundle\Entity\Message $message
     *
     * @return Messagefreelancer
     */
    public function setMessage(\MyFOSUserBundle\Entity\Message $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return \MyFOSUserBundle\Entity\Message
     */
    public function getMessage()
    {
        return $this->message;
    }
}
