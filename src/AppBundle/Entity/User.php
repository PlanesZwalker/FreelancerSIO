<?php

namespace AppBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{   
    /**
     * @var string
     */
    protected $pseudo;

    /**
     * @var string
     */
    protected $typecompte;

    
    /**
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return User
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    
    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set typecompte
     *
     * @param string $typecompte
     *
     * @return User
     */
    public function setTypecompte($typecompte)
    {
        $this->typecompte = $typecompte;

        return $this;
    }

    /**
     * Get typecompte
     *
     * @return string
     */
    public function getTypecompte()
    {
        return $this->typecompte;
    }
    
      
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    
    
}

