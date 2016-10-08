<?php

namespace freelancerppe\Domain;
/**
 * Created by PhpStorm.
 * User: Singu_Admin
 * Date: 05/02/2016
 * Time: 23:14
 *
 * Class avec les getters et setters pour les matières
 */
class Discipline
{
    private $id_discipline;
    private $name_discipline;
    private $description;

    private $dt_create;
    private $dt_update;

    //region ID la discipline
    /**
     * @return mixed
     *
     * Getter sur l'id de la matière
     */
    public function getIdDiscipline()
    {
        return $this->id_discipline;
    }

    /**
     * @param $_id_discipline
     *
     * Setter sur l'id de la matière
     */
    public function setIdDiscipline($_id_discipline)
    {
        $this->id_discipline = $_id_discipline;
    }
    //endregion

    //region pour le nom de la discipline
    /**
     * @return mixed
     *
     * Getter sur le nom de la matière
     */
    public function getNameDiscipline()
    {
        return $this->name_discipline;
    }

    /**
     * @param $_name_discipline
     *
     * Setter sur le nom de la matière
     */
    public function setNameDiscipline($_name_discipline)
    {
        $this->name_discipline = $_name_discipline;
    }
    //endregion

    //region pour la description de la discipline
    /**
     * @return mixed
     *
     * Getter sur la description de la matière
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $_description
     *
     * Setter sur la description de la matière
     */
    public function setDescription($_description)
    {
        $this->description = $_description;
    }
    //endregion

    //region de la date de création d'une matière
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
    //endregion

    //region de la date de modifiation d'une matière
    /**
     * @return mixed
     *
     * Getter sur la date de modification d'une matière
     */
    public function getDtUpdate()
    {
        return $this->dt_update;
    }

    /**
     * @param $_dt_update
     *
     * Setter sur la date de modification d'une matière
     */
    public function setDtUpdate($_dt_update)
    {
        $this->dt_update = $_dt_update;
    }
    //endregion
}
