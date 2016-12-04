<?php 
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;
 
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
     /**
     * @ORM\Column(type="string")
     */
    protected $nom;
    
     /**
     * @ORM\Column(type="string")
     */
    protected $pseudo;
    
    
 
    function getId() {
        return $this->id;
    }

    function getPseudo() {
        return $this->pseudo;
    }

    
    
    
    
    function setId($id) {
        $this->id = $id;
    }

    function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

        
    
    
    
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
}
