<?php
/**
 * Created by PhpStorm.
 * User: Singu_Admin
 * Date: 11/02/2016
 * Time: 20:42
 k*/

namespace freelancerppe\DAO;

use freelancerppe\Domain\ClassName;
use freelancerppe\Domain\Discipline;
use freelancerppe\Form\Type\AddType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use freelancerppe\Domain\Student;

class ClassNameDAO extends DAO
{
    private $studentDAO;

    /**
     * @param Student $_studentDAO
     * Dépendance sur les étudiants
     */
    public function setStudentDAO(Student $_studentDAO)
    {
        $this->studentDAO = $_studentDAO;
    }

    /**
     * @param $id
     * @return ClassName
     * @throws \Exception
     *
     * Retourne une classe par son id
     */
    public function findClassname($id)
    {
        $sql = "SELECT * FROM className WHERE id_class=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucune classe pour l'id : ".$id);
    }


    /**
     * @return array
     *
     * Retourne et affiche toutes les classes
     */
    public function findAll()
    {
        $sql = "SELECT * FROM className ORDER BY id_class";

        $res = $this->getDb()->fetchAll($sql);

        $classNames = array();
        foreach($res as $row){
            $_classNameId = $row['id_class'];
            $classNames[$_classNameId] = $this->buildDomainObject($row);
        }

        return $classNames;
    }

    /**
     * @param $id
     * @return ClassName
     * @throws \Exception
     *
     * Compte les étudiants par classe
    **/
    public function countStudentByClass($id)
    {
        $_sql = "select * from className inner join student on student.id_class = className.id_class where student.id_class =?";

        $res = $this->getDb()->fetchAll($_sql, array($id));

        return count($res);
    }

    /**
     * @return int
     *
     * Retourne le nombre de classes
     */
        public function countAll()
    {
        $sql = "SELECT * FROM className ORDER BY class_name";

        $res = $this->getDb()->fetchAll($sql);

        $classNames_total = array();
        foreach($res as $row){
            $_classNameId = $row['id_class'];
            $classNames_total[$_classNameId] = $this->buildDomainObject($row);
        }

        return count($classNames_total);
    }

    public function findAllId()
    {
        $sql = "SELECT id_class FROM className";

        $res = array($this->getDb()->fetchAll($sql));

        return $res;
    }

    /**
     * @param ClassName $_className
     * Fonction de sauvegarde et de modification des classes
     */
    public function saveClassName(ClassName $_className)
    {
        $class = array(
            'class_name'       => $_className->getClassName(),
            'class_type'       => $_className->getClassType(),
            'class_option'     => $_className->getClassOption(),
            'class_year'       => $_className->getClassYear(),
            'description'      => $_className->getDescription(),
            'dt_create'        => $_className->getDtCreate(),
            'dt_update'        => $_className->getDtUpdate(),
        );

        //on modifie
        if($_className->getIdClassName())
        {
            $this->getDb()->update('className', $class, array(
                'id_class' => $_className->getIdClassName()));
        }
        //on sauvegarde
        else{
            $this->getDb()->insert('className', $class);
            $_id_className = $this->getDb()->lastInsertId();
            $_className->setIdClassName($_id_className);
        }
    }

    /**
     * @param $id
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     *
     * Fonction de suppression d'une classe
     */
    public function deleteClassName($id)
    {
        $this->getDb()->delete('className', array(
            'id_class' => $id
        ));
    }

    /**
     * @param $row
     * @return ClassName
     *
     * construction de l'objet concernant les classes
     */
    protected function buildDomainObject($row)
    {
        $class = new ClassName();
        $class->setIdClassName($row['id_class']);

        $class->setClassName($row['class_name']);
        $class->setClassType($row['class_type']);
        $class->setClassOption($row['class_option']);
        $class->setClassYear($row['class_year']);
        $class->setDescription($row['description']);

        $class->setDtCreate($row['dt_create']);
        $class->setDtUpdate($row['dt_update']);

        return $class;
    }


}
