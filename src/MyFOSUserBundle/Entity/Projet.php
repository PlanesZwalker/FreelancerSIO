<?php

namespace MyFOSUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projet
 *
 * @ORM\Table(name="projet", indexes={@ORM\Index(name="societe", columns={"societe"})})
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
     * @var \Societe
     *
     * @ORM\ManyToOne(targetEntity="Societe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="societe", referencedColumnName="id")
     * })
     */
    private $societe;
    
    private $cahierdescharges;


    function getId() {
        return $this->id;
    }

    function getIntitule() {
        return $this->intitule;
    }

    function getDescription() {
        return $this->description;
    }

    function getPrix() {
        return $this->prix;
    }

    function getEtat() {
        return $this->etat;
    }

    function getSociete() {
        return $this->societe;
    }

    function setIntitule($intitule) {
        $this->intitule = $intitule;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setPrix($prix) {
        $this->prix = $prix;
    }

    function setEtat($etat) {
        $this->etat = $etat;
    }

    function setSociete($societe) {
        $this->societe = $societe;
    }

    function getCahierdescharges() {
        return $this->cahierdescharges;
    }

    function setCahierdescharges($cahierdescharges) {
        $this->cahierdescharges = $cahierdescharges;
    }



}

