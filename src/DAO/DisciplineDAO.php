<?php
/**
 * Created by PhpStorm.
 * User: Singu_Admin
 * Date: 11/02/2016
 * Time: 20:42
 */

namespace freelancerppe\DAO;

use Silex\Application;
use freelancerppe\Domain\Discipline;


class DisciplineDAO extends DAO
{
    /**
     * @return array
     *
     * Recherche et affiche toutes les matières
     */
    public function findAll()
    {
        $_sql = "SELECT * FROM discipline ORDER BY name_discipline ASC";
        $_res = $this->getDb()->fetchAll($_sql);

        $matieres = array();
        foreach($_res as $row){
            $matiereId = $row['id_discipline'];
            $matieres[$matiereId] = $this->buildDomainObject($row);
        }

        return $matieres;
    }

    public function findUserByDiscipline()
    {
        $_sql = "select * from discipline
                inner join users on users.id_discipline = discipline.id_discipline
                order by discipline.id_discipline";
        $_res = $this->getDb()->fetchAll($_sql);

        $matieres = array();
        foreach($_res as $row){
            $matiereId = $row['id_discipline'];
            $matieres[$matiereId] = $this->buildDomainObject($row);
        }

        return $matieres;
    }
    
            /**
     * @return int
     *
     * Retourne le nombre de disciplines
     */
    public function countAll()
    {
        $_sql = "SELECT * FROM discipline ";
        $_res = $this->getDb()->fetchAll($_sql);

        $matieres_total = array();
        foreach($_res as $row){
            $matiereId = $row['id_discipline'];
            $matieres_total[$matiereId] = $this->buildDomainObject($row);
        }

        return count($matieres_total);
    }

    /**
     * @param $id
     * @return Discipline
     * @throws \Exception
     * fonction de recherche de matière unique par ID
     */
    public function findDiscipline($id)
    {
        $sql = "SELECT * FROM discipline WHERE id_discipline=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if($row){
            return $this->buildDomainObject($row);
        }
        else{
            throw new \Exception("Aucune matière pour l'id : ".$id);
        }
    }

    /**
     * @param Discipline $_discipline
     *
     * Ajout et modification d'une matière
     */
    public function saveDiscipline(Discipline $_discipline)
    {
        $disciplineData = array(
            'name_discipline'  => $_discipline->getNameDiscipline(),
            'description'      => $_discipline->getDescription(),
            'dt_create'        => $_discipline->getDtCreate(),
            'dt_update'        => $_discipline->getDtUpdate(),
        );

        if($_discipline->getIdDiscipline()){
            $this->getDb()->update('discipline', $disciplineData, array(
                'id_discipline' => $_discipline->getIdDiscipline()));
        }
        else{
            $this->getDb()->insert('discipline', $disciplineData);
            $id = $this->getDb()->lastInsertId();
            $_discipline->setIdDiscipline($id);
        }
    }

    /**
     * @param $id
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     *
     * Suppression d'une matière par l'id
     */
    public function deleteDiscipline($id)
    {
        $this->getDb()->delete('discipline', array(
            'id_discipline' => $id
        ));
    }

    /**
     * @param $row
     * @return Discipline
     *
     * Construction de l'objet Discipline, la matière
     */
    protected function buildDomainObject($row)
    {
        $discipline = new Discipline();

        $discipline->setIdDiscipline($row['id_discipline']);

        $discipline->setNameDiscipline($row['name_discipline']);
        $discipline->setDescription($row['description']);

        $discipline->setDtCreate($row['dt_create']);
        $discipline->setDtUpdate($row['dt_update']);

        return $discipline;
    }

}
