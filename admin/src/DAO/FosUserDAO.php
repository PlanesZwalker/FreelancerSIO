<?php

namespace freelancerppe\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use freelancerppe\Domain\FosUser;


class FosUserDAO extends DAO implements UserProviderInterface
{
    public function findUser($id)
    {
        $sql = "SELECT * FROM fos_user WHERE username=?";
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
        $sql = "SELECT * FROM fos_user ORDER BY roles, nom";
        $res = $this->getDb()->fetchAll($sql);

        $fos_users = array();
        
        foreach($res as $row)
        {
            $id_user = $row['id'];
            $fos_users[$id_user] = $this->buildDomainObject($row);
        }

        return $fos_users;
    }

    /**
     * @return array
     *
     * Filtre affichant les professeurs
     */
    public function findAllFreelancer()
    {
        $sql = "SELECT * FROM fos_user"
            . " WHERE roles = 'ROLE_FREELANCER'";

        $res = $this->getDb()->fetchAll($sql);
        $freelancers = array();
        foreach ($res as $row) {
            $freelancerID = $row['id'];
            $freelancers[$freelancerID] = $this->buildDomainObject($row);
        }
        return $freelancers;
    }
    

    // fonction count a utiliser directement dans les autres fonctions
    public function countAll()
    {
        $sql = "SELECT * FROM fos_user";
        $res = $this->getDb()->fetchAll($sql);

        $users_total = array();
        foreach($res as $row)
        {
            $id_user = $row['id'];
            $users_total[$id_user] = $this->buildDomainObject($row);
        }

        return count($users_total);
    }
    
    //SELECTIONNE LES INFOS DU USER PRENDS EN PARAMETRE LE USERNAME
    public function loadUserByUsername($username)
    {
        $sql = "SELECT * FROM fos_user WHERE nom=?";
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
        return 'freelancerppe\Domain\FosUser' === $class;
    }
   
    
    // ENREGISTRE LE USER 
  /* public function saveUser(User $user)
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
*/
    
                             // Delete LE USER 
    
    public function deleteUser($id)
    {     
        $this->getDb()->delete('fos_user', array(
            'id' => $id
        ));
    }
    
    // CRÉE NOTRE INSTANCE DE LA CLASSE USER
    protected function buildDomainObject($row)
    {
        $fos_user = new FosUser();

        $fos_user->setPassword($row['password']);
        $fos_user->setUsername($row['username']);
        $fos_user->setUsernameCanonical($row['username_canonical']);
        $fos_user->setEnabled($row['enabled']);
        $fos_user->setPassword($row['password']);
        $fos_user->setEmail($row['email']);
        $fos_user->setEmailcanonical($row['email_canonical']);
        $fos_user->setExpired($row['expired']);
        $fos_user->setExpired($row['locked']);
        $fos_user->setNom($row['nom']);


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
        return $fos_user;
    }
}