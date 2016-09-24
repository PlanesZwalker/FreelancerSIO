<?php
/**
 * Created by PhpStorm.
 * User: Singu_Admin
 * Date: 12/03/2016
 * Time: 16:02
 */

namespace freelancerppe\DAO;

use freelancerppe\Domain\StatutStudent;


class StatutStudentDAO extends DAO
{
    /**
     * @return array
     *
     * On recherche tous les statuts étudiants possibles
     */
    public function findAll()
    {
        $_sql = "SELECT * FROM statutStudent ORDER BY id_statut ASC";
        $_res = $this->getDb()->fetchAll($_sql);

        $statuts = array();
        foreach($_res as $row){
            $statutId = $row['id_statut'];
            $statuts[$statutId] = $this->buildDomainObject($row);
        }

        return $statuts;
    }

    /**
     * @param $id
     * @return StatutStudent
     * @throws \Exception
     *
     * On recherche un statut étudiant par son id
     */
    public function findStatut($id_statut)
    {
        $sql = "SELECT * FROM statutStudent WHERE id_statut=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id_statut));

        if($row){
            return $this->buildDomainObject($row);
        }
        else{
            throw new \Exception("Aucun statut pour l'id : ".$id_statut);
        }
    }

    /**
     * @return int
     *
     * On compte tous les statuts, peut être utile...
     */
    public function countAll()
    {
        $_sql = "SELECT * FROM statutStudent ";
        $_res = $this->getDb()->fetchAll($_sql);

        $statut_total = array();
        foreach($_res as $row){
            $statutId = $row['id_statut'];
            $statut_total[$statutId] = $this->buildDomainObject($row);
        }

        return count($statut_total);
    }

    /**
     * @param StatutStudent $_statut
     *
     * Sauvegarde et modification du statut en base de données
     */
    public function saveStatutStudent(StatutStudent $_statut)
    {
        $statutData = array(
            'statut_student'   => $_statut->getStatutStudent(),
            'dt_create'        => $_statut->getDtCreate(),
            'dt_update'        => $_statut->getDtUpdate(),
        );

        if($_statut->getId()){
            $this->getDb()->update('statutStudent', $statutData, array(
                'id_statut' => $_statut->getId()));
        }
        else{
            $this->getDb()->insert('statutStudent', $statutData);
            $id_statut = $this->getDb()->lastInsertId();
            $_statut->setId($id_statut);
        }
    }

    /**
     * @param $id
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     *
     * Suppression du statut
     */
    public function deleteStatutStudent($id)
    {
        $this->getDb()->delete('statut_Student', array(
            'id_statut' => $id
        ));
    }

    /**
     * @param $row
     * @return StatutStudent
     *
     * Construction de l'objet de statut étudiant
     */
    protected function buildDomainObject($row)
    {
        $statutStudent = new StatutStudent();

        $statutStudent->setId($row['id_statut']);
        $statutStudent->setStatutStudent($row['statut_student']);

        $statutStudent->setDtCreate($row['dt_create']);
        $statutStudent->setDtUpdate($row['dt_update']);

        return $statutStudent;
    }
}