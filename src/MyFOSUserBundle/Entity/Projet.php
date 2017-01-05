<?php

namespace MyFOSUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projet
 *
 * @ORM\Table(name="projet", indexes={@ORM\Index(name="societe", columns={"societe"}), @ORM\Index(name="cahierdescharges", columns={"cahierdescharges"})})
 * @ORM\Entity
 */
class Projet
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=255, nullable=false)
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
     * @ORM\Column(name="prix", type="string", length=255, nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=false)
     */
    private $etat;

    /**
     * @var \Cahierdescharges
     *
     * @ORM\ManyToOne(targetEntity="Cahierdescharges")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cahierdescharges", referencedColumnName="id")
     * })
     */
    private $cahierdescharges;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Projet
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
     * @return Projet
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
     * Set prix
     *
     * @param string $prix
     *
     * @return Projet
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Projet
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set cahierdescharges
     *
     * @param \MyFOSUserBundle\Entity\Cahierdescharges $cahierdescharges
     *
     * @return Projet
     */
    public function setCahierdescharges(\MyFOSUserBundle\Entity\Cahierdescharges $cahierdescharges = null)
    {
        $this->cahierdescharges = $cahierdescharges;

        return $this;
    }

    /**
     * Get cahierdescharges
     *
     * @return \MyFOSUserBundle\Entity\Cahierdescharges
     */
    public function getCahierdescharges()
    {
        return $this->cahierdescharges;
    }

    /**
     * Set societe
     *
     * @param \MyFOSUserBundle\Entity\Societe $societe
     *
     * @return Projet
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
