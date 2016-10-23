<?php

namespace freelancerppe\DAO;

use Silex\Application;
use freelancerppe\Domain\Offre;
use freelancerppe\Domain\Freelancer;

class OffreDAO extends DAO
{
    /**
     * @return array
     *
     * Recherche et affiche toutes les compétences
     */
    public function findAll()
    {
        $_sql = "SELECT * FROM offre ";
        $_res = $this->getDb()->fetchAll($_sql);

        $offres = array();
        foreach($_res as $row){
            $offreId = $row['id_offre'];
            $offres[$offreId] = $this->buildDomainObject($row);
        }

        return $offres;
    }

            /**
     * @return int
     *
     * Retourne le nombre de offres
     */
    public function countAll()
    {
        $_sql = "SELECT * FROM offre ";
        $_res = $this->getDb()->fetchAll($_sql);

        $offres_total = array();
        foreach($_res as $row){
            $offreId = $row['id_offre'];
            $offres_total[$offreId] = $this->buildDomainObject($row);
        }

        return count($offres_total);
    }

    /**
     * @param $id
     * @return Offre
     * @throws \Exception
     * fonction de recherche de compétences unique par ID
     */
    public function findOffre($id)
    {
        $sql = "SELECT * FROM offre WHERE id_offre=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if($row){
            return $this->buildDomainObject($row);
        }
        else{
            throw new \Exception("Aucune offre pour l'id : ".$id);
        }
    }

    /**
     * @param Offre $_offre
     *
     * Ajout et modification d'une offre
     */
    public function saveOffre(Offre $_offre)
    {
        $offreData = array(
            'description'      => $_offre->getDescription(),
            'dt_create'        => $_offre->getDtCreate(),
            'dt_update'        => $_offre->getDtUpdate(),
        );

        if($_offre->getIdOffre()){
            $this->getDb()->update('offre', $offreData, array(
                'id_offre' => $_offre->getIdOffre()));
        }
        else{
            $this->getDb()->insert('offre', $offreData);
            $id = $this->getDb()->lastInsertId();
            $_offre->setIdOffre($id);
        }
    }

    /**
     * @param $id
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     *
     * Suppression d'une offre par l'id
     */
    public function deleteOffre($id)
    {
        $this->getDb()->delete('offre', array(
            'id_offre' => $id
        ));
    }

    /**
     * @param $row
     * @return Offre
     *
     * Construction de l'objet Offre, la offre
     */
    protected function buildDomainObject($row)
    {
        $offre = new Offre();

        $offre->setId_offre($row['id_offre']);

     /*   $offre->setNameOffre($row['name_offre']);
        $offre->setDescription($row['description']);

        $offre->setDtCreate($row['dt_create']);
        $offre->setDtUpdate($row['dt_update']);
*/
        return $offre;
    }

}
