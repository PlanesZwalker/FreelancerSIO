<?php

namespace MyFOSUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offre
 *
 * @ORM\Table(name="offre", indexes={@ORM\Index(name="freelancer", columns={"freelancer"}), @ORM\Index(name="projet", columns={"projet"})})
 * @ORM\Entity
 */
class Offre {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_offre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOffre;

    /**
     * @var float
     *
     * @ORM\Column(name="tarif", type="float", precision=10, scale=0, nullable=false)
     */
    private $tarif;

    /**
     * @var string
     *
     * @ORM\Column(name="delai", type="string", length=255, nullable=false)
     */
    private $delai;

    /**
     * @var string
     *
     * @ORM\Column(name="proposition", type="string", length=255, nullable=false)
     */
    private $proposition;

    /**
     * @var string
     *
     * @ORM\Column(name="particularite", type="string", length=255, nullable=false)
     */
    private $particularite;

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
     * @var \Projet
     *
     * @ORM\ManyToOne(targetEntity="Projet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="projet", referencedColumnName="id")
     * })
     */
    private $projet;

    /**
     * Get idOffre
     *
     * @return integer
     */
    public function getIdOffre() {
        return $this->idOffre;
    }

    /**
     * Set tarif
     *
     * @param float $tarif
     *
     * @return Offre
     */
    public function setTarif($tarif) {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return float
     */
    public function getTarif() {
        return $this->tarif;
    }

    /**
     * Set delai
     *
     * @param string $delai
     *
     * @return Offre
     */
    public function setDelai($delai) {
        $this->delai = $delai;

        return $this;
    }

    /**
     * Get delai
     *
     * @return string
     */
    public function getDelai() {
        return $this->delai;
    }

    /**
     * Set proposition
     *
     * @param string $proposition
     *
     * @return Offre
     */
    public function setProposition($proposition) {
        $this->proposition = $proposition;

        return $this;
    }

    /**
     * Get proposition
     *
     * @return string
     */
    public function getProposition() {
        return $this->proposition;
    }

    /**
     * Set particularite
     *
     * @param string $particularite
     *
     * @return Offre
     */
    public function setParticularite($particularite) {
        $this->particularite = $particularite;

        return $this;
    }

    /**
     * Get particularite
     *
     * @return string
     */
    public function getParticularite() {
        return $this->particularite;
    }

    /**
     * Set freelancer
     *
     * @param \MyFOSUserBundle\Entity\Freelancer $freelancer
     *
     * @return Offre
     */
    public function setFreelancer(\MyFOSUserBundle\Entity\Freelancer $freelancer = null) {
        $this->freelancer = $freelancer;

        return $this;
    }

    /**
     * Get freelancer
     *
     * @return \MyFOSUserBundle\Entity\Freelancer
     */
    public function getFreelancer() {
        return $this->freelancer;
    }

    /**
     * Set projet
     *
     * @param \MyFOSUserBundle\Entity\Projet $projet
     *
     * @return Offre
     */
    public function setProjet(\MyFOSUserBundle\Entity\Projet $projet = null) {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return \MyFOSUserBundle\Entity\Projet
     */
    public function getProjet() {
        return $this->projet;
    }

}
