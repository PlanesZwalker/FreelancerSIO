<?php

namespace freelancerppe\Domain;
/**
 * Created by PhpStorm.
 * User: Singu_Admin
 * Date: 05/02/2016
 * Time: 23:30
 *
 * Getters et setters des évaluations, regroupant les notes
 * et les appréciations
 */
class Evaluation
{
    private $id_evaluation;
    private $grade_student;
    private $judgement;

    private $student;
    private $examen;

    private $dt_create;
    private $dt_update;

    private $id_examen;
    private $id_student;

    //region ID de l'évaluation
    /**
     * @return mixed
     *
     * Getter sur l'id de la note
     */
    public function getIdEvaluation(){
        return $this->id_evaluation;
    }

    /**
     * @param $_id_evaluation
     *
     * Setter sur l'id de la note
     */
    public function setIdEvaluation($_id_evaluation)
    {
        $this->id_evaluation = $_id_evaluation;
    }
    //endregion

    //region de la note de l'évaluation a l'élève
    /**
     * @return mixed
     *
     * Getter sur la note de l'étudiant
     */
    public function getGradeStudent(){
        return $this->grade_student;
    }

    /**
     * @param $_grade_student
     *
     * Setter sur la note de l'étudiant
     */
    public function setGradeStudent($_grade_student)
    {
        $this->grade_student = $_grade_student;
    }
    //endregion

    //region de l'appréciation de l'élève
    /**
     * @return mixed
     *
     * Getter sur l'appréciation de l'élève
     */
    public function getJudgement(){
        return $this->judgement;
    }

    /**
     * @param $_judgement
     *
     * Setter sur l'appréciation de l'élève
     */
    public function setJudgement($_judgement)
    {
        $this->judgement = $_judgement;
    }
    //endregion

    //region de l'objet Etudiant
    /**
     * @return mixed
     *
     * Getter sur l'objet étudiant
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param Student $student
     *
     * Setter sur l'objet étudiant
     */
    public function setStudent(Student $student)
    {
        $this->student = $student;
    }
    //endregion

    //region l'objet examen
    /**
     * @return mixed
     *
     * Getter pour l'objet Examen
     */
    public function getExamen()
    {
        return $this->examen;
    }

    /**
     * @param Examen $examen
     *
     * Setter pour l'objet Examen
     */
    public function setExamen(Examen $examen)
    {
        $this->examen = $examen;
    }
    //endregion

    //region de la date de création de la note
    /**
     * @return mixed
     *
     * Getter sur la date de création
     */
    public function getDtCreate(){
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

    //region de la date de modification de la note
    /**
     * @return mixed
     *
     * Getter sur la date de modification
     */
    public function getDtUpdate(){
        return $this->dt_update;
    }

    /**
     * @param $_dt_update
     *
     * Setter sur la date de modification
     */
    public function setDtUpdate($_dt_update)
    {
        $this->dt_update = $_dt_update;
    }
    //endregion

    //region de l'objet IdExamen
    /**
     * @return mixed
     *
     * Getter sur l'objet IdExamen
     */
    public function getIdExamen()
    {
        return $this->id_examen;
    }

    /**
     * @param $id_examen
     *
     * Setter sur l'objet IdExamen
     */
    public function setIdExamen($id_examen)
    {
        $this->id_examen = $id_examen;
    }
    //endregion

    public function getIdStudent()
    {
        return $this->id_student;
    }

    public function setIdStudent($_id_student)
    {
        $this->id_student = $_id_student;
    }

}
