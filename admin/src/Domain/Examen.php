<?php
/**
 * Created by PhpStorm.
 * User: Singu_Admin
 * Date: 28/02/2016
 * Time: 11:57
 */

namespace freelancerppe\Domain;


class Examen
{
    private $id_examen;
    private $examen_name;
    private $coeff_examen;
    private $date_examen;
    private $description_examen;
    private $semestre;

    private $class;
    private $discipline;

    private $dt_create;
    private $dt_update;


    //region de l'ID de l'examen
    /**
     * @return mixed
     *
     * Getter sur l'id de l'examen
     */
    public function getIdExamen()
    {
        return $this->id_examen;
    }

    /**
     * @param $id_examen
     *
     * Setter sur l'id de l'examen
     */
    public function setIdExamen($id_examen)
    {
        $this->id_examen = $id_examen;
    }
    //endregion

    //region du coefficient de l'évaluation
    /**
     * @return mixed
     *
     * Getter sur le coefficient de l'examen
     */
    public function getCoeffExamen()
    {
        return $this->coeff_examen;
    }

    /**
     * @param $_coeff_examen
     *
     * Setter sur le coefficient de l'examen
     */
    public function setCoeffExamen($_coeff_examen)
    {
        $this->coeff_examen = $_coeff_examen;
    }
    //endregion

    //region pour les classes
    /**
     * @return mixed
     *
     * Getter sur l'objet de la classe
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param ClassName $class
     *
     * Setter sur l'objet de la classe
     */
    public function setClass(ClassName $class)
    {
        $this->class = $class;
    }
    //endregion

    //region GETTER et SETTER pour les matières
    /**
     * @return mixed
     *
     * Getter sur l'objet matière
     */
    public function getDiscipline()
    {
        return $this->discipline;
    }

    /**
     * @param Discipline $_discipline
     *
     * Setter sur l'objet matière
     */
    public function setDiscipline(Discipline $_discipline)
    {
        $this->discipline = $_discipline;
    }
    //endregion

    //region du nom de l'examen
    /**
     * @return mixed
     *
     * Getter sur le nom de l'examen
     */
    public function getExamenName()
    {
        return $this->examen_name;
    }

    /**
     * @param $examen_name
     *
     * Setter sur le nom de l'examen
     */
    public function setExamenName($examen_name)
    {
        $this->examen_name = $examen_name;
    }
    //endregion

    //region de la date de l'examen
    /**
     * @return mixed
     *
     * Getter sur la date de l'examen
     */
    public function getDateExamen()
    {
        return $this->date_examen;
    }

    /**
     * @param $date
     *
     * Setter sur la date de l'examen
     */
    public function setDateExamen($date)
    {
        $this->date_examen = $date;
    }
    //endregion


    //region de description de l'examen
    /**
     * @return mixed
     *
     * Getter sur la description de l'examen
     */
    public function getDescriptionExamen()
    {
        return $this->description_examen;
    }

    /**
     * @param $description_examen
     *
     * Setter sur la description de l'examen
     */
    public function setDescriptionExamen($description_examen)
    {
        $this->description_examen = $description_examen;
    }
    //endregion

    //region de description de semestre
    /**
     * @return mixed
     *
     * Getter pour récupérer le semester de l'examen
     */
    public function getSemestre()
    {
        return $this->semestre;
    }

    /**
     * @param $_semestre
     *
     * Setter sur le semestre de l'examen
     */
    public function setSemestre($_semestre)
    {
        $this->semestre = $_semestre;
    }
    //endregion


    //region de la date de création de l'examen
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
     * @param $dt_create
     *
     * Setter sur la date de création
     */
    public function setDtCreate($dt_create)
    {
        $this->dt_create = $dt_create;
    }
    //endregion

    //region de la date de modification d'un examen
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
     * @param $dt_update
     *
     * Setter sur la date de modification
     */
    public function setDtUpdate($dt_update)
    {
        $this->dt_update = $dt_update;
    }
    //endregion
}