<?php
/**
 * Created by PhpStorm.
 * User: Singu_Admin
 * Date: 28/02/2016
 * Time: 11:57
 */

namespace freelancerppe\DAO;

use freelancerppe\Domain\Examen;


class ExamenDAO extends DAO
{
    private $classDAO;
    private $disciplineDAO;

    public function setDisciplineDAO(DisciplineDAO $_disciplineDAO)
    {
        $this->disciplineDAO = $_disciplineDAO;
    }

    public function setClassDAO(ClassNameDAO $_classDAO)
    {
        $this->classDAO = $_classDAO;
    }

 /*************************************************

      @param $id
      @return mixed
      @throws \Exception

      Retourne un examen par l'id

********************************************************/
    public function findExamen($id)
    {
        $sql = "SELECT * FROM examen WHERE id_examen=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if($row){
            return $this->buildDomainObject($row);
        }
        else{
            throw new \Exception("Aucun examen pour l'id : ".$id);
        }
    }

    /*************************************************

    @param $id
    @return mixed
    @throws \Exception

    Retourne un examen par l'id

     ********************************************************/

    public function findDisciplineByExamen($id)
    {
        $sql = "SELECT *
                FROM examen
                INNER JOIN discipline on discipline.id_discipline = examen.id_discipline
                WHERE examen.id_discipline=?";

        $row = $this->getDb()->fetchAssoc($sql, array($id));
        if($row){
            return $this->buildDomainObject($row);
        }
        else{
            throw new \Exception("Aucune matière trouvée pour cette matière");
        }


    }

/**************************************************
      @return array

      Retourne tous les examens

 *************************************************/
    public function findAll()
    {
        $sql = "SELECT * FROM examen ORDER BY examen_name";

        $res = $this->getDb()->fetchAll($sql);

        $exams = array();
        foreach($res as $row){
            $_examenID = $row['id_examen'];
            $exams[$_examenID] = $this->buildDomainObject($row);
        }

        return $exams;
    }

/**************************************************
      @return int

     Retourne le nombre total d'examen

*************************************************/
    public function countAll()
    {
        $sql = "SELECT * FROM examen ORDER BY examen_name";

        $res = $this->getDb()->fetchAll($sql);

        $exams_total = array();
        foreach($res as $row){
            $_examenID = $row['id_examen'];
            $exams_total[$_examenID] = $this->buildDomainObject($row);
        }

        return count($exams_total);
    }

/**************************************************
      @param Examen $_examen

      Fonction de sauvegarde d'un examen

*************************************************/
    public function saveExamen(Examen $_examen)
    {
        $exam = array(
            'examen_name'           => $_examen->getExamenName(),
            'coeff_examen'          => $_examen->getCoeffExamen(),
            'date'                  => $_examen->getDateExamen(),
            'description'           => $_examen->getDescriptionExamen(),
            'semestre'              => $_examen->getSemestre(),
            'id_class'              => $_examen->getClass()->getIdClassName(),
            'id_discipline'         => $_examen->getDiscipline()->getIdDiscipline(),
            'dt_create'             => $_examen->getDtCreate(),
            'dt_update'             => $_examen->getDtUpdate(),
        );

        //on modifie
        if($_examen->getIdExamen())
        {
            $this->getDb()->update('examen', $exam, array(
                'id_examen'=> $_examen->getIdExamen()));
        }
        //on sauvegarde
        else
        {
            $this->getDb()->insert('examen', $exam);
         //   $_id_examen = $this->getDb()->lastInsertId();
         //   $_examen->setIdExamen($_id_examen);

        }
    }


/**************************************************

      @param $id_class

      Fonction de recherche d'un examen en fonction de la classe

 *************************************************/

    public function findAllExamenByClass($id_class)
    {
        $class = $this->classDAO->findClassname($id_class);

        $sql = "SELECT * FROM examen WHERE id_class= ? ORDER BY id_examen";
        $res = $this->getDb()->fetchAll($sql, array($id_class));

        $examens = array();
        foreach($res as $row)
        {
            $examID = $row['id_examen'];
            $examen = $this->buildDomainObject($row);
            $examen->setClass($class);
            $examens[$examID] = $examen;
        }

        return $examens;
    }

/**************************************************
      @param $id

      Suppression d'un examen par l'id

*************************************************/
    public function deleteExamen($id)
    {
        $this->getDb()->delete('examen', array(
            'id_examen' => $id
        ));
    }

/**************************************************

      @param $row
      @return Examen

      Création de l'objet examen

*************************************************/
    protected function buildDomainObject($row)
    {

        $exam = new Examen();
        $exam->setIdExamen($row['id_examen']);

        $exam->setExamenName($row['examen_name']);
        $exam->setCoeffExamen($row['coeff_examen']);
        $exam->setDateExamen($row['date']);
        $exam->setDescriptionExamen($row['description']);
        $exam->setSemestre($row['semestre']);
        $exam->setDtCreate($row['dt_create']);
        $exam->setDtUpdate($row['dt_update']);

        if (array_key_exists('id_class', $row))
        {
            $classID = $row['id_class'];
            $class = $this->classDAO->findClassname($classID);

            $exam->setClass($class);
        }

        if(array_key_exists('id_discipline', $row))
        {
            $disciplineID = $row['id_discipline'];
            $discipline = $this->disciplineDAO->findDiscipline($disciplineID);

            $exam->setDiscipline($discipline);
        }
        return $exam;
    }

}