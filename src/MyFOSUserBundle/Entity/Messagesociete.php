<?php

namespace MyFOSUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Messagesociete
 *
 * @ORM\Table(name="messagesociete", uniqueConstraints={@ORM\UniqueConstraint(name="message", columns={"message"})}, indexes={@ORM\Index(name="societe", columns={"societe"})})
 * @ORM\Entity
 */
class Messagesociete
{
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
     * @var \Societe
     *
     * @ORM\ManyToOne(targetEntity="Societe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="societe", referencedColumnName="id")
     * })
     */
    private $societe;



    /**
     * Set message
     *
     * @param \MyFOSUserBundle\Entity\Message $message
     *
     * @return Messagesociete
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

    /**
     * Set societe
     *
     * @param \MyFOSUserBundle\Entity\Societe $societe
     *
     * @return Messagesociete
     */
    public function setSociete(\MyFOSUserBundle\Entity\Societe $societe = null)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe
     *
     * @return \MyFOSUserBundle\Entity\Societe
     */
    public function getSociete()
    {
        return $this->societe;
    }
}
