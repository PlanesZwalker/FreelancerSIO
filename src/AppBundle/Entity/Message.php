<?php

namespace AppBundle\Entity;

/**
 * Message
 */
class Message
{
    /**
     * @var int
     */
    private $idMessage;

    /**
     * @var int
     */
    private $idFreelancer;

    /**
     * @var int
     */
    private $idSociete;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $sujet;

    /**
     * @var string
     */
    private $contenu;

    /**
     * @var \Datetime
     */
    private $date;

    /**
     * @var int
     */
    private $idAdmin;


    /**
     * Get id
     *
     * @return int
     */
    public function getIdMessage()
    {
        return $this->idMessage;
    }

    /**
     * Set idFreelancer
     *
     * @param integer $idFreelancer
     *
     * @return Message
     */
    public function setIdFreelancer($idFreelancer)
    {
        $this->idFreelancer = $idFreelancer;

        return $this;
    }

    /**
     * Get idFreelancer
     *
     * @return int
     */
    public function getIdFreelancer()
    {
        return $this->idFreelancer;
    }

    /**
     * Set idSociete
     *
     * @param integer $idSociete
     *
     * @return Message
     */
    public function setIdSociete($idSociete)
    {
        $this->idSociete = $idSociete;

        return $this;
    }

    /**
     * Get idSociete
     *
     * @return int
     */
    public function getIdSociete()
    {
        return $this->idSociete;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Message
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set sujet
     *
     * @param string $sujet
     *
     * @return Message
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet
     *
     * @return string
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Message
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this; 
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set date
     *
     * @param \Datetime $date
     *
     * @return Message
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \Datetime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set idAdmin
     *
     * @param integer $idAdmin
     *
     * @return Message
     */
    public function setIdAdmin($idAdmin)
    {
        $this->idAdmin = $idAdmin;

        return $this;
    }

    /**
     * Get idAdmin
     *
     * @return int
     */
    public function getIdAdmin()
    {
        return $this->idAdmin;
    }
}

