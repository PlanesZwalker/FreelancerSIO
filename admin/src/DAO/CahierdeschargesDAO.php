<?php

namespace freelancerppe\DAO;

use Silex\Application;
use freelancerppe\Domain\Contrat;
use freelancerppe\Domain\Cahierdescharges;

class CahierdeschargesDAO extends DAO
{
    /**
     * @return array
     *
     * Recherche et affiche toutes les cahier des charges
     */
    public function findAll()
    {
        $_sql = "SELECT * FROM cahierdescharges ";
        $_res = $this->getDb()->fetchAll($_sql);

        $cahierdescharges = array();
        foreach($_res as $row){
            $cahierdeschargesId = $row['id_cdc'];
            $cahierdescharges[$cahierdeschargesId] = $this->buildDomainObject($row);
        }

        return $cahierdescharges;
    }

            /**
     * @return int
     *
     * Retourne le nombre de cahierdeschargess
     */
    public function countAll()
    {
        $_sql = "SELECT * FROM cahierdescharges ";
        $_res = $this->getDb()->fetchAll($_sql);

        $cahierdescharges_total = array();
        foreach($_res as $row){
            $cahierdeschargesId = $row['id_cdc'];
            $cahierdescharges_total[$cahierdeschargesId] = $this->buildDomainObject($row);
        }

        return count($cahierdescharges_total);
    }

    /**
     * @param $id
     * @return Contrat
     * @throws \Exception
     * fonction de recherche de cahier des charges unique par ID
     */
    public function findContrat($id)
    {
        $sql = "SELECT * FROM cahierdescharges WHERE id_cdc=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if($row){
            return $this->buildDomainObject($row);
        }
        else{
            throw new \Exception("Aucune cahierdescharges pour l'id : ".$id);
        }
    }

    /**
     * @param Contrat $_cahierdescharges
     *
     * Ajout et modification d'une cahierdescharges
     */
    public function saveContrat(Contrat $_cahierdescharges)
    {
        $cahierdeschargesData = array(
            'description'      => $_cahierdescharges->getDescription(),
            'dt_create'        => $_cahierdescharges->getDtCreate(),
            'dt_update'        => $_cahierdescharges->getDtUpdate(),
        );

        if($_cahierdescharges->getId_cahierdescharges()){
            $this->getDb()->update('cahierdescharges', $cahierdeschargesData, array(
                'id_cdc' => $_cahierdescharges->getId_cahierdescharges()));
        }
        else{
            $this->getDb()->insert('cahierdescharges', $cahierdeschargesData);
            $id = $this->getDb()->lastInsertId();
            $_cahierdescharges->setId_cahierdescharges($id);
        }
    }

    /**
     * @param $id
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     *
     * Suppression d'une cahierdescharges par l'id
     */
    public function deleteContrat($id)
    {
        $this->getDb()->delete('cahierdescharges', array(
            'id_cdc' => $id
        ));
    }

    /**
     * @param $row
     * @return Contrat
     *
     * Construction de l'objet Contrat, la cahierdescharges
     */
    protected function buildDomainObject($row)
    {
        $cahierdescharges = new Contrat();

        $cahierdescharges->setId_cahierdescharges($row['id_cdc']);

        return $cahierdescharges;
    }

}
