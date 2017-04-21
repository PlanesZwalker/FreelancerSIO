<?php

namespace MyFOSUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offreprojet
 *
 * @ORM\Table(name="offreprojet", indexes={@ORM\Index(name="id_offre", columns={"id_offre"}), @ORM\Index(name="id_projet", columns={"id_projet"})})
 * @ORM\Entity
 */
class Offreprojet {

    /**
     * @var \Offre
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Offre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_offre", referencedColumnName="id_offre")
     * })
     */
    private $idOffre;

    /**
     * @var \Projet
     *
     * @ORM\ManyToOne(targetEntity="Projet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_projet", referencedColumnName="id")
     * })
     */
    private $idProjet;

    /**
     * Set idOffre
     *
     * @param \MyFOSUserBundle\Entity\Offre $idOffre
     *
     * @return Offreprojet
     */
    public function setIdOffre(\MyFOSUserBundle\Entity\Offre $idOffre) {
        $this->idOffre = $idOffre;

        return $this;
    }

    /**
     * Get idOffre
     *
     * @return \MyFOSUserBundle\Entity\Offre
     */
    public function getIdOffre() {
        return $this->idOffre;
    }

    /**
     * Set idProjet
     *
     * @param \MyFOSUserBundle\Entity\Projet $idProjet
     *
     * @return Offreprojet
     */
    public function setIdProjet(\MyFOSUserBundle\Entity\Projet $idProjet = null) {
        $this->idProjet = $idProjet;

        return $this;
    }

    /**
     * Get idProjet
     *
     * @return \MyFOSUserBundle\Entity\Projet
     */
    public function getIdProjet() {
        return $this->idProjet;
    }

}
