<?php

namespace AppBundle\Entity;

/**
 * Freelancer
 */
class Freelancer
{
    /**
     * @var int
     */
    private $idFreelancer;

    /**
     * @var string
     */
    private $urlCv;

    /**
     * @var string
     */
    private $urlPhoto;

    /**
     * @var int
     */
    private $age;

    /**
     * @var int
     */
    private $idUser;


    /**
     * Get id
     *
     * @return int
     */
    public function getIdFreelancer()
    {
        return $this->idFreelancer;
    }

    /**
     * Set urlCv
     *
     * @param string $urlCv
     *
     * @return Freelancer
     */
    public function setUrlCv($urlCv)
    {
        $this->urlCv = $urlCv;

        return $this;
    }

    /**
     * Get urlCv
     *
     * @return string
     */
    public function getUrlCv()
    {
        return $this->urlCv;
    }

    /**
     * Set urlPhoto
     *
     * @param string $urlPhoto
     *
     * @return Freelancer
     */
    public function setUrlPhoto($urlPhoto)
    {
        $this->urlPhoto = $urlPhoto;

        return $this;
    }

    /**
     * Get urlPhoto
     *
     * @return string
     */
    public function getUrlPhoto()
    {
        return $this->urlPhoto;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Freelancer
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Freelancer
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

