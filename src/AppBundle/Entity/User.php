<?php 
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;
 
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\AttributeOverrides({
 *   
 * })
 *
 */


//   @ORM\AttributeOverride(name="id", column=@ORM\Column(type="string", name="email_address", length=255))

//  @OneToOne(targetEntity="Freelancer")   

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
    protected $pseudo;
    
    /**
     * 
     * @ORM\Column(type="string")
     */
    protected $typecompte;
    
        
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
    
    function getTypecompte() {
        return $this->typecompte;
    }

    function setTypecompte($typecompte) {
        $this->typecompte = $typecompte;
    }

    function getPseudo() {
        return $this->pseudo;
    }

    function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }
 
    
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    

}
