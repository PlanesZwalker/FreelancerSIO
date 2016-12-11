<?php

namespace AppBundle\Entity;

/**
 * Admin
 */
class Admin
{
    /**
     * @var int
     */
    private $idAdmin;

    /**
     * @var int
     */
    private $idUser;


    /**
     * Get id
     *
     * @return int
     */
    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Admin
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

