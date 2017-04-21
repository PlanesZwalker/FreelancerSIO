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


}

