<?php
/**
 * Created by PhpStorm.
 * User: Val
 * Date: 11/02/2016
 * Time: 15:10
 */

namespace freelancerppe\DAO;

use freelancerppe\Domain\Student;
use freelancerppe\Domain\ClassName;
use Symfony\Component\Validator\Constraints\Null;


class StudentDAO extends DAO
{
    private $classDAO;
    private $evaluationDAO;
    private $examenDAO;
//    private $statutDAO;
     /**
     * @param mixed $_statutDAO
      **/

 /*   public function setStatutStudentDAO(StatutStudentDAO $_statutDAO)
    {
        $this->statutDAO = $_statutDAO;
    }
*/


    /**
     * @param ExamenDAO $_examenDAO
     */
    public function setExamenDAO(ExamenDAO $_examenDAO)
    {
        $this->examenDAO = $_examenDAO;
    }

    /**
     * @param EvaluationDAO $_evaluationDAO
     */
    public function setEvaluationDAO(EvaluationDAO $_evaluationDAO)
    {
        $this->evaluationDAO = $_evaluationDAO;
    }

    /**
     * @param ClassNameDAO $_classDAO
     */
    public function setClassDAO(ClassNameDAO $_classDAO)
    {
        $this->classDAO = $_classDAO;
    }

    /**
     * @return array
     *
     * Recherche tous les étudiants
     */
    public function findAll()
    {
        $_sql = "SELECT * FROM student ORDER BY id_student";
        $_res = $this->getDb()->fetchAll($_sql);

        $etudiants = array();
        foreach($_res as $row)
        {
            $etudiantId = $row['id_student'];
            $etudiants[$etudiantId] = $this->buildDomainObject($row);
        }
        
        return $etudiants;
    }
    
      /**
     * @return int
     *
     * retourne le nombre d' étudiants
     */
    public function countAll()
    {
        $_sql = "SELECT * FROM student ORDER BY student_name";
        $_res = $this->getDb()->fetchAll($_sql);

        $etudiants_total = array();
        foreach($_res as $row){
            $etudiantId = $row['id_student'];
            $etudiants_total[$etudiantId] = $this->buildDomainObject($row);
        }
        return count($etudiants_total);
    }
    

    /**
     * @param $id
     * @return Student
     * @throws \Exception
     *
     * Recherche un étudiant par son id
     */
    public function findStudent($id)
    {
        $sql = "SELECT * FROM student WHERE id_student=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if($row){
            return $this->buildDomainObject($row);
        }
        else{
            throw new \Exception("Aucun étudiant pour l'id : ".$id);
        }
    }

    public function findAllStudentByClass($id_class)
    {
        $_sql = "SELECT * FROM student WHERE id_class=?";
        $_res = $this->getDb()->fetchAll($_sql, array($id_class));

        $etudiants = array();
        foreach($_res as $row){
            $etudiantID = $row['id_student'];
            $etudiants[$etudiantID] = $this->buildDomainObject($row);
        }
        return $etudiants;
    }

    public function CountStudentByClass(ClassName $className)
    {
        $_sql = "SELECT id_student FROM student WHERE id_class=?";

        $_res = $this->getDb()->fetchAll($_sql, array($className->getIdClassName()));

        $CountStudentByClass = count($_res);

        return $CountStudentByClass;
    }



    /**
     * @param Student $student
     * Fonction de sauvegarde d'un étudiant
     */
    public function saveStudent(Student $student)
    {
        $studentInfo = array(
            'student_name'      => $student->getName(),
            'student_firstname' => $student->getFirstname(),
            'student_birthday'  => $student->getBirthday(),
            'student_email'     => $student->getEmail(),
            'student_address'   => $student->getAddress(),
            'student_tel'       => $student->getTel(),
            'dt_create'         => $student->getDtCreate(),
            'dt_update'         => $student->getDtUpdate(),

            'id_class'          => $student->getClass()->getIdClassName(),
     //       'id_statut'         => $student->getStatut()->getId(),
        );

        //on modifie
        if($student->getIdStudent()){
            $this->getDb()->update('student', $studentInfo, array(
                'id_student' => $student->getIdStudent()));
        }
        //on sauvegarde
        else{
            $this->getDb()->insert('student', $studentInfo);
            $id = $this->getDb()->lastInsertId();
            $student->setIdStudent($id);
        }
    }

    /**
     * @param $id
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     *
     * Fonction de suppression d'un utilisateur
     */
    public function deleteStudent($id)
    {
        $this->getDb()->delete('student', array(
            'id_student' => $id
        ));
    }

    /**
     * @param $classId
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     *
     * Fonction de mise à jour de la clé étrangère de la classe
     */
    public function deleteAllByClass($classId, Student $student)
    {
        $studentInfo = array(
            'student_name'      => $student->getName(),
            'student_firstname' => $student->getFirstname(),
            'student_birthday'  => $student->getBirthday(),
            'student_email'     => $student->getEmail(),
            'student_address'   => $student->getAddress(),
            'student_tel'       => $student->getTel(),
            'dt_create'         => $student->getDtCreate(),
            'dt_update'         => $student->getDtUpdate(),

            'id_class'          => $student->getClass()->getIdClassName(),
    //        'id_statut'         => $student->getStatut()->getId(),
        );

        $this->getDb()->update('student', $studentInfo, array(
            'id_student' => $classId
        ));
    }

    /**
     * @param $row
     * @return Student
     *
     * Construction d'un objet étudiant
     */
    protected function buildDomainObject($row)
    {
        $student = new Student();

        $student->setIdStudent($row['id_student']);

        $student->setName($row['student_name']);
        $student->setFirstname($row['student_firstname']);
        $student->setBirthday($row['student_birthday']);
        $student->setAddress($row['student_address']);
        $student->setEmail($row['student_email']);
        $student->setTel($row['student_tel']);

        $student->setDtCreate($row['dt_create']);
        $student->setDtUpdate($row['dt_update']);
        
        
        $classNameID = $row['id_class'];
        if($classNameID)
        {
            $classname = $this->classDAO->findClassname($classNameID);
            $student->setClass($classname);   
        }
/*
        if(array_key_exists('id_statut', $row))
        {
            $statutID = $row['id_statut'];
            $statut = $this->statutDAO->findStatut($statutID);
            $student->setStatut($statut);
        }*/
        
        return $student;
    }
}
