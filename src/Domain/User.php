<?php

namespace freelancerppe\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    private $id_users;
    private $username;
    private $name;
    private $firstname;
    private $description;
    private $password;
    private $salt;
    private $role;
    private $mail;
    private $tel;

    private $discipline;

    private $dt_create;
    private $dt_update;


    //region Getter et Setter de l'ID de l'utilisateur
    public function getIdUsers()
    {
        return $this->id_users;
    }

    public function setIdUsers($_id_users)
    {
        $this->id_users = $_id_users;
    }
    //endregion

    //region Getter et Setter du pseudo de l'utilisateur
    public function getUsername()
    {
        return $this->username;
    }
    
    public function setUsername($_username)
    {
        $this->username = $_username;
    }
    //endregion

    //region Getter et Setter du nom de l'utilisateur
    public function getName()
    {
        return $this->name;
    }

    public function setName($_name)
    {
        $this->name = $_name;
    }
    //endregion

    //region Getter et Setter du prénom de l'utilisateur
    public function getFirstName()
    {
        return $this->firstname;
    }

    public function setFirstName($_firstname)
    {
        $this->firstname = $_firstname;
    }
    //endregion

    //region Getter et Setter du mot de passe de l'utilisateur
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($_password)
    {
        $this->password = $_password;
    }
    //endregion

    //region Getter et Setter de Hachage du mot de passe
    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($_salt)
    {
        $this->salt = $_salt;
    }
    //endregion

    //region Getter et Setter du role de l'utilisateur
    public function getRole()
    {
        return $this->role;
    }

    public function setRole($_role)
    {
        $this->role = $_role;
    }
    //endregion


    //region Getter et Setter de l'Email de l'utilisateur
    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($_mail)
    {
        $this->mail = $_mail;
    }
    //endregion

    //region Getter et Setter du tel de l'utilisateur
    public function getTel()
    {
        return $this->tel;
    }

    public function setTel($_tel)
    {
        $this->tel = $_tel;
    }

    //region Getter et Setter de la description de l'utilisateur
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($_description)
    {
        $this->description = $_description;
    }
    //endregion

    //region Getter et Setter de la date de création de l'utilisateur
    public function getDtCreate()
    {
        return $this->dt_create;
    }

    public function setDtCreate($_dt_create)
    {
        $this->dt_create = $_dt_create;
    }
    //endregion

    //region Getter et Setter de la date de modification de l'utilisateur
    public function getDtUpdate()
    {
        return $this->dt_update;
    }

    public function setDtUpdate($_dt_update)
    {
        $this->dt_update = $_dt_update;
    }
    //endregion

    //region Getter et Setter des matières
    public function getDiscipline()
    {
        return $this->discipline;
    }

    public function setDiscipline(Discipline $discipline)
    {
        $this->discipline = $discipline;
    }
    //endregion


    public function hydrate(array $datas)  // Permet d'initialiser les attributs
    {
        if(isset($datas['uti_id_users']))
        {
            $this->setIdUsers($datas['uti_id_users']);
        }
        if(isset($datas['uti_username']))
        {
            $this->setUsername($datas['uti_username']);
        }
        if(isset($datas['uti_name']))
        {
            $this->setName($datas['uti_name']);
        }
        if(isset($datas['uti_firstname']))
        {
            $this->setFirstName($datas['uti_firstname']);
        }
        if(isset($datas['uti_mail']))
        {
            $this->setMail($datas['uti_mail']);
        }
        if(isset($datas['uti_password']))
        {
            $this->setPassword($datas['uti_password']);
        }
        if(isset($datas['uti_salt']))
        {
            $this->setSalt($datas['uti_salt']);
        }
        if(isset($datas['uti_role']))
        {
            $this->setRole($datas['uti_role']);
        }
    }
    public function __toString()
    {
        $res = "ID 	 -> ". $this->getIdUsers() ."\r";
        $res .= "Nom     -> ". $this->getName() ."\r";
        $res .= "Prenom  -> ". $this->getFirstName() ."\r";
        $res .= "E-mail  -> ". $this->getMail() ."\r";
        $res .= "Password    -> ". $this->getPassword() ."\r";
        $res .= "Role    -> ". $this->getRole();
        return $res;
    }

    //Getter des roles des utilisateur
    public function getRoles()
    {
        return array($this->getRole());
    }

    public function eraseCredentials()
    {
        // Nothing to do here;
    }
    

}