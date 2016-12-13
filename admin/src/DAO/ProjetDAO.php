<?php

namespace freelancerppe\DAO;

//use freelancerppe\Form\Type\AddType;
//use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use freelancerppe\Domain\Freelancer;
use freelancerppe\Domain\Projet;

class ProjetDAO extends DAO
{
    //private $freelancerDAO;

    /**
     * @param Freelancer $_freelancerDAO
     * Dépendance sur les freelancers
     */
 /*   public function setStudentDAO(Student $_freelancerDAO)
    {
        $this->freelancerDAO = $_freelancerDAO;
    }
*/
    /**
     * @param $id
     * @return Projet
     * @throws \Exception
     *
     * Retourne un projet par son id
     */
    public function findProjet($id)
    {
        $sql = "SELECT * FROM projet WHERE id_projet=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if($row){
            return $this->buildDomainObject($row);
        }
        else{
            throw new \Exception("Aucun projet pour l'id_projet : ".$id);
    
        }
    }

    /**
     * @return array
     *
     * Retourne et affiche tous les projets
     */
    public function findAll()
    {
        $sql = "SELECT * FROM projet ORDER BY id_projet";

        $res = $this->getDb()->fetchAll($sql);

        $Projets = array();
        foreach($res as $row){
            $_ProjetId = $row['id_projet'];
            $Projets[$_ProjetId] = $this->buildDomainObject($row);
        }

        return $Projets;
    }

    /**
     * @param $id
     * @return Projet
     * @throws \Exception
     *
     * Compte les projets par freelancer
    **/
    public function countProjetByFreelancer($id)
    {
        $_sql = "select * from projet inner join freelancer on freelancer.id_projet = projet.id_projet where freelancer.id_projet =?";

        $res = $this->getDb()->fetchAll($_sql, array($id));

        return count($res);
    }

    /**
     * @return int
     *
     * Retourne le nombre de projets
     */
        public function countAll()
    {
        $sql = "SELECT * FROM projet ";

        $res = $this->getDb()->fetchAll($sql);

        $Projets_total = array();
        foreach($res as $row){
            $_ProjetId = $row['id_projet'];
            $Projets_total[$_ProjetId] = $this->buildDomainObject($row);
        }

        return count($Projets_total);
    }

    public function findAllId()
    {
        $sql = "SELECT id_projet FROM projet";

        $res = array($this->getDb()->fetchAll($sql));

        return $res;
    }

    /**
     * @param Projet $_Projet
     * Fonction de sauvegarde et de modification des projets
     */
    public function saveProjet(Projet $_Projet)
    {
        $class = array(
            'projet'       => $_Projet->getProjet(),
            'class_type'       => $_Projet->getClassType(),
            'class_option'     => $_Projet->getClassOption(),
            'class_year'       => $_Projet->getClassYear(),
            'description'      => $_Projet->getDescription(),
            'dt_create'        => $_Projet->getDtCreate(),
            'dt_update'        => $_Projet->getDtUpdate(),
        );

        //on modifie
        if($_Projet->getid_projet())
        {
            $this->getDb()->update('Projet', $class, array(
                'id_projet' => $_Projet->getid_projet()));
        }
        //on sauvegarde
        else{
            $this->getDb()->insert('Projet', $class);
            $_id_Projet = $this->getDb()->lastInsertId();
            $_Projet->setid_projet($_id_Projet);
        }
    }

    /**
     * @param $id
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     *
     * Fonction de suppression d'une classe
     */
    public function deleteProjet($id)
    {
        $this->getDb()->delete('projet', array(
            'id_projet' => $id
        ));
    }

    /**
     * @param $row
     * @return Projet
     *
     * construction de l'objet concernant les projets
     */
    protected function buildDomainObject($row)
    {
        $class = new Projet();
        $class->setId_Projet($row['id_projet']);
        $class->setPrix($row['prix']) ;
        $class->setEtape($row['etape']);
        $class->setDescription($row['description']) ;
        $class->setId_societe($row['id_societe']);
        $class->setId_cdc($row['id_cdc']);
        $class->setDescription($row['description']);

        return $class;
    }


}
