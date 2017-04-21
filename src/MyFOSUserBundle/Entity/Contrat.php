<?php

namespace MyFOSUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contrat
 *
 * @ORM\Table(name="contrat", indexes={@ORM\Index(name="paiement", columns={"paiement"}), @ORM\Index(name="projet", columns={"projet"})})
 * @ORM\Entity
 */
class Contrat {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_contrat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContrat;

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
     * @var \DateTime
     *
     * @ORM\Column(name="date_sign", type="datetime", nullable=false)
     */
    private $dateSign;

    /**
     * @var \Paiement
     *
     * @ORM\ManyToOne(targetEntity="Paiement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paiement", referencedColumnName="id_paiement")
     * })
     */
    private $paiement;

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
     * Get idContrat
     *
     * @return integer
     */
    public function getIdContrat() {
        return $this->idContrat;
    }

    /**
     * Set tarif
     *
     * @param float $tarif
     *
     * @return Contrat
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
     * @return Contrat
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
     * Set dateSign
     *
     * @param \DateTime $dateSign
     *
     * @return Contrat
     */
    public function setDateSign($dateSign) {
        $this->dateSign = $dateSign;

        return $this;
    }

    /**
     * Get dateSign
     *
     * @return \DateTime
     */
    public function getDateSign() {
        return $this->dateSign;
    }

    /**
     * Set paiement
     *
     * @param \MyFOSUserBundle\Entity\Paiement $paiement
     *
     * @return Contrat
     */
    public function setPaiement(\MyFOSUserBundle\Entity\Paiement $paiement = null) {
        $this->paiement = $paiement;

        return $this;
    }

    /**
     * Get paiement
     *
     * @return \MyFOSUserBundle\Entity\Paiement
     */
    public function getPaiement() {
        return $this->paiement;
    }

    /**
     * Set projet
     *
     * @param \MyFOSUserBundle\Entity\Projet $projet
     *
     * @return Contrat
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
