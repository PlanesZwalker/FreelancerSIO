<?php

namespace freelancerppe\DAO;

use Silex\Application;
use freelancerppe\Domain\Contrat;
use freelancerppe\Domain\Freelancer;

class ContratDAO extends DAO
{
    /**
     * @return array
     *
     * Recherche et affiche toutes les compétences
     */
    public function findAll()
    {
        $_sql = "SELECT * FROM contrat ";
        $_res = $this->getDb()->fetchAll($_sql);

        $contrats = array();
        foreach($_res as $row){
            $contratId = $row['id_contrat'];
            $contrats[$contratId] = $this->buildDomainObject($row);
        }

        return $contrats;
    }

            /**
     * @return int
     *
     * Retourne le nombre de contrats
     */
    public function countAll()
    {
        $_sql = "SELECT * FROM contrat ";
        $_res = $this->getDb()->fetchAll($_sql);

        $contrats_total = array();
        foreach($_res as $row){
            $contratId = $row['id_contrat'];
            $contrats_total[$contratId] = $this->buildDomainObject($row);
        }

        return count($contrats_total);
    }

    /**
     * @param $id
     * @return Contrat
     * @throws \Exception
     * fonction de recherche de compétences unique par ID
     */
    public function findContrat($id)
    {
        $sql = "SELECT * FROM contrat WHERE id_contrat=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if($row){
            return $this->buildDomainObject($row);
        }
        else{
            throw new \Exception("Aucune contrat pour l'id : ".$id);
        }
    }

    /**
     * @param Contrat $_contrat
     *
     * Ajout et modification d'une contrat
     */
    public function saveContrat(Contrat $_contrat)
    {
        $contratData = array(
            'description'      => $_contrat->getDescription(),
            'dt_create'        => $_contrat->getDtCreate(),
            'dt_update'        => $_contrat->getDtUpdate(),
        );

        if($_contrat->getId_contrat()){
            $this->getDb()->update('contrat', $contratData, array(
                'id_contrat' => $_contrat->getId_contrat()));
        }
        else{
            $this->getDb()->insert('contrat', $contratData);
            $id = $this->getDb()->lastInsertId();
            $_contrat->setId_contrat($id);
        }
    }

    /**
     * @param $id
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     *
     * Suppression d'une contrat par l'id
     */
    public function deleteContrat($id)
    {
        $this->getDb()->delete('contrat', array(
            'id_contrat' => $id
        ));
    }

    /**
     * @param $row
     * @return Contrat
     *
     * Construction de l'objet Contrat, la contrat
     */
    protected function buildDomainObject($row)
    {
        $contrat = new Contrat();

        $contrat->setId_contrat($row['id_contrat']);

      //  $contrat->setNameContrat($row['name_contrat']);
       // $contrat->setDescription($row['description']);

      //  $contrat->setDtCreate($row['dt_create']);
      //  $contrat->setDtUpdate($row['dt_update']);

        return $contrat;
    }

}
