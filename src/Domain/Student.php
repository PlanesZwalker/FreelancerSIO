<?php

namespace freelancerppe\Domain;
/**
 * Created by PhpStorm.
 * User: Singu_Admin
 * Date: 05/02/2016
 * Time: 23:07
 *
 * Getters et setters des étudiants
 */
class Student
{
    private $id_student;

    private $student_name;
    private $student_firstname;
    private $student_birthday;
    private $student_email;
    private $student_address;
    private $student_tel;

   // private $statut;
    private $class;
    private $examen;

    private $dt_create;
    private $dt_update;

    //region Getter et Setter de l'ID de l'étudiant
    public function getIdStudent()
    {
        return $this->id_student;
    }

    public function setIdStudent($_id_student)
    {
        $this->id_student = $_id_student;
    }
    //endregion

    //region Getter et Setter du nom de l'étudiant
    public function getName()
    {
        return $this->student_name;
    }

    public function setName($_student_name)
    {
        $this->student_name = $_student_name;
    }
    //endregion

    //region Getter et Setter du prénom de l'étudiant
    public function getFirstname()
    {
        return $this->student_firstname;
    }

    public function setFirstname($_student_firstname)
    {
        $this->student_firstname = $_student_firstname;
    }
    //endregion

    //region Getter et Setter de la date de naissance de l'étudiant
    public function getBirthday()
    {
        return $this->student_birthday;
    }

    public function setBirthday($_student_birthday)
    {
        $this->student_birthday = $_student_birthday;
    }
    //endregion

    //region Getter et Setter de l'Email de l'étudiant
    public function getEmail()
    {
        return $this->student_email;
    }

    public function setEmail($_student_email)
    {
        $this->student_email = $_student_email;
    }
    //endregion

    //region Getter et Setter de l'adresse de l'étudiant
    public function getAddress()
    {
        return $this->student_address;
    }

    public function setAddress($_student_address)
    {
        $this->student_address = $_student_address;
    }
    //endregion

    //region Getter et Setter du numéro de téléphone de l'étudiant
    public function getTel()
    {
        return $this->student_tel;
    }

    public function setTel($_student_tel)
    {
        $this->student_tel = $_student_tel;
    }

    /**
     * @return mixed
     */
   /* public function getStatut()
    {
        return $this->statut;
    }
*/
    /**
     * @param mixed $statut
     */
   /* public function setStatut(StatutStudent $statut)
    {
        $this->statut = $statut;
    }*/
    //endregion


    //region Getter et Setter de l'objet Classe
    /**
     * @return mixed
     */
    public function getClass()
    {
        if (!$this->class)
            $this->class = new ClassName();
            
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass(ClassName $class)
    {
        $this->class = $class;
    }
    //endregion

    //region Getter et Setter de la date de création de l'étudiant
    public function getDtCreate()
    {
        return $this->dt_create;
    }

    public function setDtCreate($_dt_create)
    {
        $this->dt_create = $_dt_create;
    }
    //endregion

    //region Getter et Setter de la modification d'un étudiant
    public function getDtUpdate()
    {
        return $this->dt_update;
    }

    public function setDtUpdate($_dt_update)
    {
        $this->dt_update = $_dt_update;
    }
    //endregion


    /**
     * @return mixed
     */
    public function getExamen()
    {
        return $this->examen;
    }

    /**
     * @param mixed $examen
     */
    public function setExamen(Examen $examen)
    {
        $this->examen = $examen;
    }
}
