<?php

namespace freelancerppe\DAO;

use freelancerppe\Domain\Freelancer;
// use Symfony\Component\Validator\Constraints\Null; deprecated in PHP7 
//use Symfony\Component\Validator\Constraints;

class FreelancerDAO extends DAO
{
    /**
     * @return array
     *
     * Recherche tous les freelancers
     */
    public function findAll()
    {
        $_sql = "SELECT * FROM freelancer ORDER BY id_freelancer";
        $_res = $this->getDb()->fetchAll($_sql);

        $freelancers = array();
        foreach($_res as $row)
        {
            $freelancerId = $row['id_freelancer'];
            $freelancers[$freelancerId] = $this->buildDomainObject($row);
        }
        return $freelancers;
    }
    
      /**
     * @return int
     *
     * retourne le nombre de freelancers
     */
    public function countAll()
    {
        $_sql = "SELECT * FROM freelancer";
        $_res = $this->getDb()->fetchAll($_sql);

        $freelancers_total = array();
        foreach($_res as $row){
            $freelancerId = $row['id_freelancer'];
            $freelancers_total[$freelancerId] = $this->buildDomainObject($row);
        }
        return count($freelancers_total);
    }

    /**
     * @param $id
     * @return Freelancer
     * @throws \Exception
     *
     * Recherche un étudiant par son id
     */
    public function findFreelancer($id)
    {
        $sql = "SELECT * FROM freelancer WHERE id_freelancer=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if($row){
            return $this->buildDomainObject($row);
        }
        else{
            throw new \Exception("Aucun étudiant pour l'id : ".$id);
        }
    }
/*
    public function findAllFreelancerByClass($id_class)
    {
        $_sql = "SELECT * FROM freelancer WHERE id_class=?";
        $_res = $this->getDb()->fetchAll($_sql, array($id_class));

        $freelancers = array();
        foreach($_res as $row){
            $etudiantID = $row['id_freelancer'];
            $freelancers[$etudiantID] = $this->buildDomainObject($row);
        }
        return $freelancers;
    }

    public function CountFreelancerByClass(ClassName $className)
    {
        $_sql = "SELECT id_freelancer FROM freelancer WHERE id_class=?";

        $_res = $this->getDb()->fetchAll($_sql, array($className->getIdClassName()));

        $CountFreelancerByClass = count($_res);

        return $CountFreelancerByClass;
    }
*/


    /**
     * @param Freelancer $freelancer
     * Fonction de sauvegarde d'un étudiant
     */
  /*  public function saveFreelancer(Freelancer $freelancer)
    {
        $freelancerInfo = array(
            'freelancer_name'      => $freelancer->getName(),
            'freelancer_firstname' => $freelancer->getFirstname(),
            'freelancer_birthday'  => $freelancer->getBirthday(),
            'freelancer_email'     => $freelancer->getEmail(),
            'freelancer_address'   => $freelancer->getAddress(),
            'freelancer_tel'       => $freelancer->getTel(),
            'dt_create'         => $freelancer->getDtCreate(),
            'dt_update'         => $freelancer->getDtUpdate(),

            'id_class'          => $freelancer->getClass()->getIdClassName(),
     //       'id_statut'         => $freelancer->getStatut()->getId(),
        );

        //on modifie
        if($freelancer->getIdFreelancer()){
            $this->getDb()->update('freelancer', $freelancerInfo, array(
                'id_freelancer' => $freelancer->getIdFreelancer()));
        }
        //on sauvegarde
        else{
            $this->getDb()->insert('freelancer', $freelancerInfo);
            $id = $this->getDb()->lastInsertId();
            $freelancer->setIdFreelancer($id);
        }
    }
*/
    /**
     * @param $id
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     *
     * Fonction de suppression d'un utilisateur
     */
    public function deleteFreelancer($id)
    {
        $this->getDb()->delete('freelancer', array(
            'id_freelancer' => $id
        ));
    }

    /**
     * @param $classId
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     *
     * Fonction de mise à jour de la clé étrangère de la classe
     */
  /*  public function deleteAllByClass($classId, Freelancer $freelancer)
    {
        $freelancerInfo = array(
            'freelancer_name'      => $freelancer->getName(),
            'freelancer_firstname' => $freelancer->getFirstname(),
            'freelancer_birthday'  => $freelancer->getBirthday(),
            'freelancer_email'     => $freelancer->getEmail(),
            'freelancer_address'   => $freelancer->getAddress(),
            'freelancer_tel'       => $freelancer->getTel(),
            'dt_create'         => $freelancer->getDtCreate(),
            'dt_update'         => $freelancer->getDtUpdate(),

            'id_class'          => $freelancer->getClass()->getIdClassName(),
    //        'id_statut'         => $freelancer->getStatut()->getId(),
        );

        $this->getDb()->update('freelancer', $freelancerInfo, array(
            'id_freelancer' => $classId
        ));
    }
*/
    /**
     * @param $row
     * @return Freelancer
     *
     * Construction d'un objet de la classe Freelancer
     */
    protected function buildDomainObject($row)
    {
        $freelancer = new Freelancer();

        $freelancer->setId_freelancer($row['id_freelancer']);
     /*   $freelancer->setPseudo($row['pseudo']);
        $freelancer->setNomuser($row['nomuser']);
        $freelancer->setPrenomuser($row['prenomuser']);
       
        $freelancer->setAdresse($row['adresse']);
        $freelancer->setEmail($row['email']);
        $freelancer->setTelephone($row['telephone']);

        $freelancer->setDate_insc($row['date_insc']);
        $freelancer->setDate_modif($row['date_modif']);
  */
        return $freelancer;
    }
}
