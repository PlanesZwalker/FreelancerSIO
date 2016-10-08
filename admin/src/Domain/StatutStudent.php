<?php
/**
 * Created by PhpStorm.
 * User: Singu_Admin
 * Date: 12/03/2016
 * Time: 16:01
 */

namespace freelancerppe\Domain;


class StatutStudent
{
    private $id_statut;
    private $statut_student;
    private $dt_create;
    private $dt_update;

    /**
     * @return mixed
     *
     * Getter sur l'id du statut
     */
    public function getId()
    {
        return $this->id_statut;
    }

    /**
     * @param mixed $id
     *
     * Setter sur l'id du statut
     */
    public function setId($id_statut)
    {
        $this->id_statut = $id_statut;
    }

    /**
     * @return mixed
     *
     * Getter sur le statut de l'étudiant
     */
    public function getStatutStudent()
    {
        return $this->statut_student;
    }

    /**
     * @param mixed $statut_student
     *
     * Setter sur le statut de l'étudiant
     */
    public function setStatutStudent($statut_student)
    {
        $this->statut_student = $statut_student;
    }

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
     * @param mixed $dt_create
     *
     * Setter sur la date de création
     */
    public function setDtCreate($dt_create)
    {
        $this->dt_create = $dt_create;
    }

    /**
     * @return mixed
     *
     * Getter sur la date de modification
     */
    public function getDtUpdate()
    {
        return $this->dt_update;
    }

    /**
     * @param mixed $dt_update
     *
     * Setter sur la date de modification
     */
    public function setDtUpdate($dt_update)
    {
        $this->dt_update = $dt_update;
    }




}