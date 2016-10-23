<?php

namespace freelancerppe\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use freelancerppe\Domain\User;


class UserDAO extends DAO implements UserProviderInterface
{
    public function findUser($id)
    {
        $sql = "SELECT * FROM user WHERE id_user=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if($row){
            return $this->buildDomainObject($row);
        }
        else
        {
            throw new \Exception("No user matching id " . $id);
        }
    }

    //Ajout de la fonction findAll, pour rechercher tous les utilisateurs
    public function findAll()
    {
        $sql = "SELECT * FROM user ORDER BY role, nomuser";
        $res = $this->getDb()->fetchAll($sql);

        $users = array();
        foreach($res as $row)
        {
            $id_user = $row['id_user'];
            $users[$id_user] = $this->buildDomainObject($row);
        }

        return $users;
    }

    /**
     * @return array
     *
     * Filtre affichant les professeurs
     */
    public function findAllFreelancer()
    {
        $sql = "SELECT * FROM user"
            . " WHERE uti_role = 'ROLE_FREELANCER'";

        $res = $this->getDb()->fetchAll($sql);
        $freelancers = array();
        foreach ($res as $row) {
            $freelancerID = $row['id_user'];
            $freelancers[$freelancerID] = $this->buildDomainObject($row);
        }
        return $freelancers;
    }
    

    // fonction count a utiliser directement dans les autres fonctions
    public function countAll()
    {
        $sql = "SELECT * FROM user";
        $res = $this->getDb()->fetchAll($sql);

        $users_total = array();
        foreach($res as $row)
        {
            $id_user = $row['id_user'];
            $users_total[$id_user] = $this->buildDomainObject($row);
        }

        return count($users_total);
    }
    
    //SELECTIONNE LES INFOS DU USER PRENDS EN PARAMETRE LE USERNAME
    public function loadUserByUsername($username)
    {
        $sql = "SELECT * FROM user WHERE nomuser=?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));

        if($row){
            return $this->buildDomainObject($row);
        }
        else{
            throw new UsernameNotFoundException(sprintf('Utilisateur "%s" non trouve.', $username));
        }
    }

    /**
     * @param UserInterface $user
     * @return User|UserInterface
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if(!$this->supportsClass($class)){
            throw new UnsupportedUserException(sprintf('instances of "%s" are not supported.', $class));
        }return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return 'freelancerppe\Domain\User' === $class;
    }
   
    
    // ENREGISTRE LE USER 
   public function saveUser(User $user)
    {     
        $userInfo= array( 
            'pseudo'      => $user->getPseudo(), 
            'nomuser'          => $user->getNomuser(),
            'prenomuser'     => $user->getPrenomuser(),
            'motdepasse'      => $user->getMotdepasse(),
            'role'          => $user->getRole(),
            'email'          => $user->getEmail(),
            'salt'          => $user->getSalt(),
            'telephone'     => $user->getTelephone(),
            'date_insc'     => $user->getDate_insc(),
            'date_modif'     => $user->getDate_modif(),        
        );
        
        //on modifie
        if($user->getId_User())
            $this->getDb()->update('user',$userInfo, array('id_user' => $user->getId_User()));
        //on sauvegarde
        else
        {
            $this->getDb()->insert('user',$userInfo);   
            $id = $this->getDb()->lastInsertId();
            $user->setId_User($id);
        }
      }

    
                             // Delete LE USER 
    
    public function deleteUser($id)
    {     
        $this->getDb()->delete('user', array(
            'id_user' => $id
        ));
    }
    
    // CRÉE NOTRE INSTANCE DE LA CLASSE USER
    protected function buildDomainObject($row)
    {
        $user = new User();
        $user->setId_User($row['id_user']);
        $user->setNomuser($row['nomuser']);
        $user->setPseudo($row['pseudo']);
        $user->setPrenomuser($row['prenomuser']);
        $user->setAdresse($row['adresse']);
        $user->setSalt($row['salt']);
        $user->setRole($row['role']);
        $user->setMotdepasse($row['motdepasse']);
        $user->setEmail($row['email']);
        $user->setTelephone($row['telephone']);

        $user->setDate_insc($row['date_insc']);
        $user->setDate_modif($row['date_modif']);

     /*   if(array_key_exists('id_discipline', $row))
        {
            $disciplineID = $row['id_discipline'];
            if($disciplineID == 0)
                $user->setDiscipline(new Discipline(0));
            else
            {
                $discipline = $this->disciplineDAO->findDiscipline($disciplineID);
                $user->setDiscipline($discipline);
            }
        }
            */ 
        return $user;
    }
}