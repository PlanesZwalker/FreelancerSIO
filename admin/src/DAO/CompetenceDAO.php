<?php
/**
 * Created by PhpStorm.
 * User: Singu_Admin
 * Date: 11/02/2016
 * Time: 20:42
 */

namespace freelancerppe\DAO;

use Silex\Application;
use freelancerppe\Domain\Competence;
use freelancerppe\Domain\Freelancer;


class CompetenceDAO extends DAO
{
    /**
     * @return array
     *
     * Recherche et affiche toutes les compétences
     */
    public function findAll()
    {
        $_sql = "SELECT * FROM competence ";
        $_res = $this->getDb()->fetchAll($_sql);

        $competences = array();
        foreach($_res as $row){
            $competenceId = $row['id_competence'];
            $competences[$competenceId] = $this->buildDomainObject($row);
        }

        return $competences;
    }

 /*   public function findUserByCompetence()
    {
        
        $_sql = "select * from competence
                inner join user on competence.id_freelancer = freelancer.id_freelancer
                order by competence.id_competence";
        $_res = $this->getDb()->fetchAll($_sql);

        $competences = array();
        foreach($_res as $row){
            $competenceId = $row['id_competence'];
            $competences[$competenceId] = $this->buildDomainObject($row);
        }

        return $competences;
    }
   */ 
            /**
     * @return int
     *
     * Retourne le nombre de competences
     */
    public function countAll()
    {
        $_sql = "SELECT * FROM competence ";
        $_res = $this->getDb()->fetchAll($_sql);

        $competences_total = array();
        foreach($_res as $row){
            $competenceId = $row['id_competence'];
            $competences_total[$competenceId] = $this->buildDomainObject($row);
        }

        return count($competences_total);
    }

    /**
     * @param $id
     * @return Competence
     * @throws \Exception
     * fonction de recherche de compétences unique par ID
     */
    public function findCompetence($id)
    {
        $sql = "SELECT * FROM competence WHERE id_competence=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if($row){
            return $this->buildDomainObject($row);
        }
        else{
            throw new \Exception("Aucune competence pour l'id : ".$id);
        }
    }

    /**
     * @param Competence $_competence
     *
     * Ajout et modification d'une competence
     */
    public function saveCompetence(Competence $_competence)
    {
        $competenceData = array(
            'name_competence'  => $_competence->getNameCompetence(),
            'description'      => $_competence->getDescription(),
            'dt_create'        => $_competence->getDtCreate(),
            'dt_update'        => $_competence->getDtUpdate(),
        );

        if($_competence->getId_competence()){
            $this->getDb()->update('competence', $competenceData, array(
                'id_competence' => $_competence->getId_competence()));
        }
        else{
            $this->getDb()->insert('competence', $competenceData);
            $id = $this->getDb()->lastInsertId();
            $_competence->setId_competence($id);
        }
    }

    /**
     * @param $id
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     *
     * Suppression d'une competence par l'id
     */
    public function deleteCompetence($id)
    {
        $this->getDb()->delete('competence', array(
            'id_competence' => $id
        ));
    }

    /**
     * @param $row
     * @return Competence
     *
     * Construction de l'objet Competence, la competence
     */
    protected function buildDomainObject($row)
    {
        $competence = new Competence();

        $competence->setId_competence($row['id_competence']);
        $competence->setDescription($row['description']);

        return $competence;
    }

}
