<?php 
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;
 
use FOS\UserBundle\Model\Competence as Competence;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="competence")
 */
class Competence 
{
    protected $categorie;
}