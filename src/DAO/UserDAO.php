<?php
/**
 * Created by PhpStorm.
 * User: nfilskov
 * Date: 12/02/2016
 * Time: 19:08
 */


namespace freelancerppe\DAO;

use freelancerppe\Domain\Discipline;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use freelancerppe\Domain\User;


class UserDAO extends DAO implements UserProviderInterface
{
    public $disciplineDAO;

    /**
     * @param mixed $_disciplineDAO
     */
    public function setDisciplineDAO(DisciplineDAO $_disciplineDAO)
    {
        $this->disciplineDAO = $_disciplineDAO;
    }

    /**
     * @param $id
     * @return User
     * @throws \Exception
     *
     * Retourne un utilisateur via son id
     */
    public function findUser($id)
    {
        $sql = "SELECT * FROM users WHERE id_users=?";
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
        $sql = "SELECT * FROM users ORDER BY role, username";
        $res = $this->getDb()->fetchAll($sql);

        $users = array();
        foreach($res as $row)
        {
            $id_user = $row['id_users'];
            $users[$id_user] = $this->buildDomainObject($row);
        }

        return $users;
    }

    /**
     * @return array
     *
     * Filtre affichant les professeurs
     */
    public function findAllTeacher()
    {
        $sql = "SELECT * FROM users"
            . " WHERE uti_role = 'ROLE_FORMATEUR'";

        $res = $this->getDb()->fetchAll($sql);
        $teachers = array();
        foreach ($res as $row) {
            $teacherID = $row['id_users'];
            $teachers[$teacherID] = $this->buildDomainObject($row);
        }
        return $teachers;
    }
    

    // fonction count a utiliser directement dans les autres fonctions
    public function countAll()
    {
        $sql = "SELECT * FROM users";
        $res = $this->getDb()->fetchAll($sql);

        $users_total = array();
        foreach($res as $row)
        {
            $id_user = $row['id_users'];
            $users_total[$id_user] = $this->buildDomainObject($row);
        }

        return count($users_total);
    }
    
    //SELECTIONNE LES INFOS DU USER PRENDS EN PARAMETRE LE USERNAME
    public function loadUserByUsername($username)
    {
        $sql = "SELECT * FROM users WHERE username=?";
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
            'username'      => $user->getUsername(), 
            'name'          => $user->getName(),
            'firstname'     => $user->getFirstname(),
            'password'      => $user->getPassword(),
            'role'          => $user->getRole(),
            'mail'          => $user->getMail(),
            'description'   => $user->getDescription(),
            'salt'          => $user->getSalt(),
            'tel'           => $user->getTel(),

            'dt_create'     => $user->getDtCreate(),
            'dt_update'     => $user->getDtUpdate(),

            'id_discipline' => $user->getDiscipline()->getIdDiscipline(),
        );
        
        //on modifie
        if($user->getIdUsers())
            $this->getDb()->update('users',$userInfo, array('id_users' => $user->getIdUsers()));
        //on sauvegarde
        else
        {
            $this->getDb()->insert('users',$userInfo);   
            $id = $this->getDb()->lastInsertId();
            $user->setIdUsers($id);
        }
      }

    
                             // Delete LE USER 
    
    public function deleteUser($id)
    {     
        $this->getDb()->delete('users', array(
            'id_users' => $id
        ));
    }
    
    // CRÉE NOTRE INSTANCE DE LA CLASSE USER
    protected function buildDomainObject($row)
    {
        $user = new User();
        $user->setIdUsers($row['id_users']);
        $user->setUsername($row['username']);
        $user->setName($row['name']);
        $user->setFirstname($row['firstname']);
        $user->setPassword($row['password']);
        $user->setSalt($row['salt']);
        $user->setRole($row['role']);
        $user->setDescription($row['description']);
        $user->setMail($row['mail']);
        $user->setTel($row['tel']);

        $user->setDtCreate($row['dt_create']);
        $user->setDtUpdate($row['dt_update']);

        if(array_key_exists('id_discipline', $row))
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
             
        return $user;
    }
}