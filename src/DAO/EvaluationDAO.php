<?php
/**
 * Created by PhpStorm.
 * User: Singu_Admin
 * Date: 11/02/2016
 * Time: 20:43
 */

namespace freelancerppe\DAO;


use freelancerppe\Domain\Evaluation;


class EvaluationDAO extends DAO
{
    private $studentDAO;
    private $examenDAO;

    /**
     * @param ExamenDAO $examenDAO
     *
     * Dépendance avec l'examen
     */
    public function setExamenDAO(ExamenDAO $examenDAO)
    {
        $this->examenDAO = $examenDAO;
    }

    /**
     * @param StudentDAO $studentDAO
     *
     * Fait une dépendance entre la classe studentDao et evaluation
     */
    public function setStudentDAO(StudentDAO $studentDAO)
    {
        $this->studentDAO = $studentDAO;
    }

    /**
     * @param $studentId
     * @return array
     *
     * Fonction de recherche par étudiant (Filtre)
     * On va rechercher toutes les notes d'un étudiant
     * Fonctionne
     */
    public function findAllByStudent($studentId)
    {
        $student = $this->studentDAO->findStudent($studentId);

        $sql = "SELECT id_evaluation, id_student, grade_student, judgement FROM evaluation WHERE id_student = ?";
        $res = $this->getDb()->fetchAll($sql, array($studentId));

        $notes = array();
        foreach($res as $row)
        {
            $noteID = $row['id_evaluation'];
            $note = $this->buildDomainObject($row);

            $note->setStudent($student);
            $notes[$noteID] = $note;
        }
        return $notes;
    }
    
    
    /**
     * @param $id_student
     * @return array
     * retourne les infos de la table evaluation d'un etudiant
     * via son id.
     */
    public function findEvalByStudent($id_student)
    {
        $student = $this->studentDAO->findStudent($id_student);
        $sql = "SELECT * FROM evaluation WHERE id_student = ?";
        $res = $this->getDb()->fetchAll($sql, array($id_student));
        $evals = array();
        foreach($res as $row)
        {
            $id_eval = $row['id_evaluation'];
            $eval = $this->buildDomainObject($row);
            $evals[$id_eval] = $eval;
        }
        return $evals;
    }

    /**
     * @param $id_student
     * @param $id_discipline
     * @return array
     *
     * Calcul de la moyenne via la base de données, pour les étudiants...
     */
    public function averageByStudent($id_student, $id_discipline)
    {
        $student = $this->studentDAO->findStudent($id_student);
        $discipline = $this->examenDAO->findDisciplineByExamen($id_discipline);

        $sql = "select
                sum(grade_student*examen.coeff_examen)/sum(examen.coeff_examen) as moyenne
                from evaluation
                inner join examen on examen.id_examen = evaluation.id_examen
                where evaluation.id_student = ? and examen.id_discipline = ?";

        $res = $this->getDb()->fetchAssoc($sql, array($id_student, $id_discipline));
        $evals = array();
        foreach($res as $row){
            $id_eval = $row['id_evaluation'];
            $eval = $this->buildDomainObject($row);
            $evals[$id_eval] = $eval;
        }
        return $evals;

    }

    /**
     * @param $id_examen
     * @return array
     *
     * retourne les infos de la table evaluation d'un examen
     * via l'id
     */
    public function findEvalByExamen($id_examen)
    {
        $examen = $this->examenDAO->findExamen($id_examen);

        $sql = "SELECT * FROM evaluation WHERE id_examen=?";
        $res = $this->getDb()->fetchAssoc($sql, array($id_examen));

        $evals = array();
        foreach($res as $row)
        {
            $id_eval = $row['id_evaluation'];
            $eval = $this->buildDomainObject($row);

            $eval->setExamen($examen);
            $evals[$id_eval] = $eval;
        }
        return $evals;
    }

    /*public function findEvalByExamenBis($id_examen)
    {
        $examen = $this->examenDAO->findExamen($id_examen);

        $sql = "select *
                from evaluation
                inner join examen on examen.id_examen = evaluation.id_examen
                inner join student on student.id_student = evaluation.id_student
                inner join className on className.id_class = examen.id_class
                where evaluation.id_examen = ?";

        $res = $this->getDb()->fetchAll($sql, array($id_examen));

        $evals = array();
        foreach($res as $row)
        {
            $id_eval = $row['id_evaluation'];
            $eval = $this->buildDomainObject($row);

            $eval->setExamen($examen);
            $evals[$id_eval] = $eval;
        }
        return $evals;

    }*/
    

    /**
     * //   FIND ALL, permet de trouver toutes les notes depuis la table
     */
    public function findAll()
    {
        $sql = "SELECT * FROM evaluation ";
        $res = $this->getDb()->fetchAll($sql);

        $matieres = array();
        foreach($res as $row)
        {
            $matiereID = $row['id_evaluation'];
            $matieres[$matiereID] = $this->buildDomainObject($row);
        }
        return $matieres;   
    }

    /**
     * @param $id
     * @return Evaluation
     * @throws \Exception
     *
     * Recherche d'une note par l'id
     */
    public function find($id)
    {
        $sql = "SELECT * FROM evaluation WHERE id_evaluation=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("Aucune note pour l'id : " . $id);
        }
    }

    /**
     * @param Evaluation $evaluation
     * Sauvegarde et modification d'une note pour l'élève
     */
    public function saveGrade(Evaluation $evaluation)
    {
        $grade = array(
            'grade_student'     => $evaluation->getGradeStudent(),
            'judgement'         => $evaluation->getJudgement(),
            'dt_create'         => $evaluation->getDtCreate(),
            'dt_update'         => $evaluation->getDtUpdate(),
            'id_student'        => $evaluation->getIdStudent(),
            'id_examen'         => $evaluation->getIdExamen(),
        );

        if($evaluation->getIdEvaluation())
        {
            $this->getDb()->update('evaluation', $grade, array(
                'id_evaluation'=> $evaluation->getIdEvaluation()));
        }
        else{
            $this->getDb()->insert('evaluation', $grade);
            /*$_id_evaluation = $this->getDb()->lastInsertId();
            $evaluation->setIdEvaluation($_id_evaluation);*/
        }
    }

    /**
     * @param $id
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     *
     * Suppression d'une note
     */
    public function deleteGrade($id)
    {
        $this->getDb()->delete('evaluation', array(
            'id_evaluation' => $id
        ));
    }

    /**
     * @param $row
     * @return Evaluation
     * création de l'objet evaluation représentant la note et l'appréciation de l'élève
     */
    protected function buildDomainObject($row)
    {
        $evaluation = new Evaluation();

        $evaluation->setIdEvaluation($row['id_evaluation']);
        $evaluation->setGradeStudent($row['grade_student']);
        $evaluation->setJudgement($row['judgement']);
        $evaluation->setDtCreate($row['dt_create']);
        $evaluation->setDtUpdate($row['dt_update']);

        if(array_key_exists('id_student', $row))
        {
            $studentID = $row['id_student'];
            if(isset($row['id_student'])){
                $student = $this->studentDAO->findStudent($studentID);
                $evaluation->setIdStudent($student);
            }
        }

        if(array_key_exists('id_examen', $row))
        {
            $examenID = $row['id_examen'];
            if(isset($row['id_examen'])) {
                $examen = $this->examenDAO->findExamen($examenID);
                $evaluation->setIdExamen($examen);
            }
        }

        return $evaluation;
    }

}
