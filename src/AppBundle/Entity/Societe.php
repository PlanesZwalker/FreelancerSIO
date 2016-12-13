<?php

namespace AppBundle\Entity;

/**
 * Societe
 */
class Societe
{
    /**
     * @var int
     */
    private $id_societe;

    /**
     * @var int
     */
    private $siret;

    /**
     * @var string
     */
    private $denomination;

    /**
     * @var int
     */
    private $idUser;


    /**
     * Get id
     *
     * @return int
     */
    public function getid_societe()
    {
        return $this->id_societe;
    }

    /**
     * Set siret
     *
     * @param integer $siret
     *
     * @return Societe
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return int
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set denomination
     *
     * @param string $denomination
     *
     * @return Societe
     */
    public function setDenomination($denomination)
    {
        $this->denomination = $denomination;

        return $this;
    }

    /**
     * Get denomination
     *
     * @return string
     */
    public function getDenomination()
    {
        return $this->denomination;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Societe
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}

