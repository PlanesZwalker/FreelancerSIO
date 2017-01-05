<?php

namespace MyFOSUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiement
 *
 * @ORM\Table(name="paiement")
 * @ORM\Entity
 */
class Paiement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_paiement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPaiement;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=false)
     */
    private $etat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dp_societe", type="datetime", nullable=false)
     */
    private $dpSociete;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dp_freelancer", type="datetime", nullable=false)
     */
    private $dpFreelancer;



    /**
     * Get idPaiement
     *
     * @return integer
     */
    public function getIdPaiement()
    {
        return $this->idPaiement;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Paiement
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
     * Set dpSociete
     *
     * @param \DateTime $dpSociete
     *
     * @return Paiement
     */
    public function setDpSociete($dpSociete)
    {
        $this->dpSociete = $dpSociete;

        return $this;
    }

    /**
     * Get dpSociete
     *
     * @return \DateTime
     */
    public function getDpSociete()
    {
        return $this->dpSociete;
    }

    /**
     * Set dpFreelancer
     *
     * @param \DateTime $dpFreelancer
     *
     * @return Paiement
     */
    public function setDpFreelancer($dpFreelancer)
    {
        $this->dpFreelancer = $dpFreelancer;

        return $this;
    }

    /**
     * Get dpFreelancer
     *
     * @return \DateTime
     */
    public function getDpFreelancer()
    {
        return $this->dpFreelancer;
    }
}
