<?php

namespace freelancerppe\DAO;

use freelancerppe\Domain\User;
use freelancerppe\Domain\Societe;

class SocieteDAO extends DAO
{

    /**
     * @param $id
     * @return Societe
     * @throws \Exception
     *
     * On sélectionne unne societe par son id
     */
    public function findSociete($id)
    {
        $sql = "SELECT * FROM societe WHERE id_societe=? ";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if($row){
            return $this->buildDomainObject($row);
        }
        else{
            throw new \Exception("Aucune societe pour l'id_societe : ".$id);
        }
    }

    /**
     * @return array
     *
     * On affiche les informations des sociétés
     */
    public function findAll()
    {
        $sql = "SELECT * FROM societe ";

        $res = $this->getDb()->fetchAll($sql);

        $societes = array();
        foreach($res as $row){
            $_societeId = $row['id_societe'];
            $societes[$_societeId] = $this->buildDomainObject($row);
        }

        return $societes;
    }

    /**
     * @return int
     *
     * On compte le nombre total de societes
     */
    public function countAll()
    {
        $sql = "SELECT * FROM societe";

        $res = $this->getDb()->fetchAll($sql);

        $societe_total = array();
        foreach($res as $row){
            $_societeId = $row['id_societe'];
            $societe_total[$_societeId] = $this->buildDomainObject($row);
        }

        return count($societe_total);
    }

    /**
     * @param User $_societe
     *
     * On sauvegarde ou modifie une société
     */
    public function saveSociete($_societe, $IdSocietes)
    {
        $societe = array(

            'pseudo'      => $_societe->getPseudo(),
            'nomuser'          => $_societe->getNomuser(),
            'prenomuser'     => $_societe->getPrenomuser(),
            'motdepasse'      => $_societe->getMotdepasse(),
            'role'          => $_societe->getRole(),
            'email'          => $_societe->getEmail(),
            'adresse'   => $_societe->getAdresse(),
            'salt'          => $_societe->getSalt(),
            'telelephone'           => $_societe->getTelephone(),
            'date_insc'     => $_societe->getDate_insc(),
            'date_modif'     => $_societe->getDate_modif()

        );

        //on modifie  
        if($IdSocietes)
        {
            $this->getDb()->update('societe', $societe, array(
                'id_societe'=> $_societe->getId_societe()));
        }
        //on sauvegarde
        else{
            $this->getDb()->insert('societe', $societe);
            $_id_societe = $this->getDb()->lastInsertId();
            $_societe->setIdUser($_id_societe);
        }
    }

    /**
     * @param $id
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     *
     * On supprime une societe par l'id
     */
    public function deleteSociete($id_societe)
    {
        $this->getDb()->delete('societe', array(
            'id_societe' => $id_societe
        ));
    }

    /**
     * @param $row
     * @return Societe
     *
     * On construit l'objet de la classe Societe
     */
    protected function buildDomainObject($row)
    {
        $societe = new Societe();

        $societe->setId_societe($row['id_societe']);
   /*     $societe->setPseudo($row['pseudo']);
        $societe->setNomuser($row['nomuser']);
        $societe->setPrenomuser($row['prenomuser']);
        $societe->setMotdepasse($row['motdepasse']);
        $societe->setSalt($row['salt']);
        $societe->setRole($row['role']);
        $societe->setAdresse($row['adresse']);
        $societe->setEmail($row['email']);
        $societe->setTelephone($row['telephone']);
        $societe->setDate_insc($row['date_insc']);
        $societe->setDate_modif($row['date_modif']);
 */
        return $societe;
    }

}