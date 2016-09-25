<?php
/**
 * Created by PhpStorm.
 * User: Singu_Admin
 * Date: 06/03/2016
 * Time: 17:18
 */

namespace freelancerppe\DAO;

use freelancerppe\Domain\User;
use freelancerppe\Domain\Teacher;
use freelancerppe\Domain\Discipline;


class TeacherDAO extends DAO
{
   // public $disciplineDAO;

    /**
     * @param mixed $_disciplineDAO
     */
   /* public function setDisciplineDAO(DisciplineDAO $_disciplineDAO)
    {
        $this->disciplineDAO = $_disciplineDAO;
    }
*/
    /**
     * @param $id
     * @return Teacher
     * @throws \Exception
     *
     * On sélectionne un professeur par son id
     */
    public function findTeacher($id)
    {
        $sql = "SELECT * FROM users WHERE role='ROLE_SOCIETE' AND id_users=? ";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if($row){
            return $this->buildDomainObject($row);
        }
        else{
            throw new \Exception("Aucun professeur pour l'id_users : ".$id);
        }
    }

    /**
     * @return array
     *
     * On affiche les professeurs
     */
    public function findAll()
    {
        $sql = "SELECT * FROM users WHERE role='SOCIETE' ORDER BY id_users";

        $res = $this->getDb()->fetchAll($sql);

        $teachers = array();
        foreach($res as $row){
            $_teacherId = $row['id_users'];
            $teachers[$_teacherId] = $this->buildDomainObject($row);
        }

        return $teachers;
    }

    /**
     * @return int
     *
     * On compte le nombre total de professeurs
     */
    public function countAll()
    {
        $sql = "SELECT * FROM users WHERE role='ROLE_SOCIETE' ORDER BY id";

        $res = $this->getDb()->fetchAll($sql);

        $teacher_total = array();
        foreach($res as $row){
            $_teacherId = $row['id_class'];
            $teacher_total[$_teacherId] = $this->buildDomainObject($row);
        }

        return count($teacher_total);
    }

    /**
     * @param User $_user
     *
     * On sauvegarde ou modifie un professeur
     */
    public function saveTeacher(Teacher $_user, $IdUsers)
    {
        $prof = array(

            'username'      => $_user->getUsername(),
            'name'          => $_user->getName(),
            'firstname'     => $_user->getFirstname(),
            'password'      => $_user->getPassword(),
            'role'          => $_user->getRole(),
            'mail'          => $_user->getMail(),
            'description'   => $_user->getDescription(),
            'salt'          => $_user->getSalt(),
            'tel'           => $_user->getTel(),

            'dt_create'     => $_user->getDtCreate(),
            'dt_update'     => $_user->getDtUpdate(),

          //  'id_discipline' => $_user->getDiscipline()->getIdDiscipline(),
        );

        //on modifie  
        if($IdUsers)
        {
            $this->getDb()->update('users', $prof, array(
                'id_users'=> $_user->getIdUsers()));
        }
        //on sauvegarde
        else{
            $this->getDb()->insert('users', $prof);
            $_id_user = $this->getDb()->lastInsertId();
            $_user->setIdUsers($_id_user);
        }
    }

    /**
     * @param $id
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     *
     * On supprime un professeur par l'id
     */
    public function deleteTeacher($id)
    {
        $this->getDb()->delete('users', array(
            'id' => $id
        ));
    }

    /**
     * @param $row
     * @return Teacher
     *
     * On construit l'objet Teacher (professeur)
     */
    protected function buildDomainObject($row)
    {
        $teacher = new Teacher();

        $teacher->setIdUsers($row['id_users']);
        $teacher->setUsername($row['username']);
        $teacher->setName($row['name']);
        $teacher->setFirstname($row['firstname']);
        $teacher->setPassword($row['password']);
        $teacher->setSalt($row['salt']);
        $teacher->setRole($row['role']);
        $teacher->setDescription($row['description']);
        $teacher->setMail($row['mail']);
        $teacher->setTel($row['tel']);

        $teacher->setDtCreate($row['dt_create']);
        $teacher->setDtUpdate($row['dt_update']);

      /*  if(array_key_exists('id_discipline', $row))
        {
            $disciplineID = $row['id_discipline'];
            if($disciplineID == 0)
                $teacher->setDiscipline(new Discipline(0));
            else
            {
                $discipline = $this->disciplineDAO->findDiscipline($disciplineID);
                $teacher->setDiscipline($discipline);
            }
        }*/

        return $teacher;
    }

}