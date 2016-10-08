<?php

namespace freelancerppe\Domain;
/**
 * Created by PhpStorm.
 * User: Val
 * Date: 05/02/2016
 * Time: 12:24
 *
 * Création des getters et setters des classes
 */
class ClassName
{
    private $id_class;
    private $class_name;
    private $class_type;
    private $class_option;
    private $class_year;
    private $description;

    private $student;

    private $dt_create;
    private $dt_update;

    //region ID de la classe
    /**
     * @return mixed
     *
     * Getter sur l'id de la classe
     */
    public function getIdClassName()
    {
        return $this->id_class;
    }

    /**
     * @param $_id_className
     *
     * Setter sur l'id de la classe
     */
    public function setIdClassName($_id_className)
    {
        $this->id_class = $_id_className;
    }
    //endregion

    //region ClassName
    /**
     * @return mixed
     *
     * Getter du nom de la classe
     */
    public function getClassName()
    {
        return $this->class_name;
    }

    /**
     * @param $_class_Name
     *
     * Setter sur le nom de la classe
     */
    public function setClassName($_class_Name)
    {
        $this->class_name = $_class_Name;
    }
    //endregion
    
   
    //region sur le type de la classe
    /**
     * @return mixed
     *
     * Getter sur le type de la classe
     */
    public function getClassType()
    {
        return $this->class_type;
    }

    /**
     * @param $_class_type
     *
     * Setter sur le type de la classe
     */
    public function setClassType($_class_type)
    {
        $this->class_type = $_class_type;
    }
    //endregion

    
    //region pour le nom de l'option
    /**
     * @return mixed
     *
     * Getter pour l'option de la classe (SLAM, SISR...)
     */
    public function getClassOption()
    {
        return $this->class_option;
    }

    /**
     * @param $_class_option
     *
     * Setter pour l'option de la classe
     */
    public function setClassOption($_class_option)
    {
        $this->class_option = $_class_option;
    }
    //endregion

    //region pour la description de la classe
    /**
     * @return mixed
     *
     * Getter sur la description de la classe
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     *
     * Setter sur la description de la classe
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    //endregion


    //region pour l'année
    /**
     * @return mixed
     *
     * Getter sur l'année de la classe
     */
    public function getClassYear()
    {
        return $this->class_year;
    }

    /**
     * @param $_class_year
     *
     * Setter sur l'année de classe
     */
    public function setClassYear($_class_year)
    {
        $this->class_year = $_class_year;
    }
    //endregion

    //region pour les dates d'ajout et de mise à jour
    /**
     * @return mixed
     *
     * Getter sur la date de création
     */
    public function getDtCreate()
    {
        return $this->dt_create;
    }

    /**
     * @param $_dt_create
     *
     * Setter sur la date de création
     */
    public function setDtCreate($_dt_create)
    {
        $this->dt_create = $_dt_create;
    }

    /**
     * @return mixed
     *
     * Getter sur la date de mise à jour
     */
    public function getDtUpdate()
    {
        return $this->dt_update;
    }

    /**
     * @param $_dt_update
     *
     * Setter sur la date de mise à jour
     */
    public function setDtUpdate($_dt_update)
    {
        $this->dt_update = $_dt_update;
    }
    //endregion

    //region Getter et Setter pour l'objet Etudiant
    /**
     * @return mixed
     * Getter sur l'objet étudiant
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param $_student
     * Setter sur l'objet étudiant
     */
    public function setStudent(Student $_student)
    {
        $this->student = $_student;
    }
    //endregion
            
}
