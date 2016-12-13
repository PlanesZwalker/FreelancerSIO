<?php

namespace freelancerppe\DAO;

use freelancerppe\Domain\Test;

class TestDAO extends DAO
{
    private $classDAO;
  //  private $competenceDAO;

/*    public function setCompetenceDAO(CompetenceDAO $_competenceDAO)
    {
        $this->competenceDAO = $_competenceDAO;
    }
*/
    public function setClassDAO(ClassNameDAO $_classDAO)
    {
        $this->classDAO = $_classDAO;
    }

 /*************************************************

      @param $id
      @return mixed
      @throws \Exception

      Retourne un test par l'id

********************************************************/
    public function findTest($id)
    {
        $sql = "SELECT * FROM test WHERE id_test=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if($row){
            return $this->buildDomainObject($row);
        }
        else{
            throw new \Exception("Aucun test pour l'id : ".$id);
        }
    }

    /*************************************************

    @param $id
    @return mixed
    @throws \Exception

    Retourne un test par l'id

     ********************************************************/
/*
    public function findCompetenceByTest($id)
    {
        $sql = "SELECT *
                FROM test
                INNER JOIN competence on competence.id_competence = test.id_competence
                WHERE test.id_competence=?";

        $row = $this->getDb()->fetchAssoc($sql, array($id));
        if($row){
            return $this->buildDomainObject($row);
        }
        else{
            throw new \Exception("Aucune matière trouvée pour cette matière");
        }


    }
*/
/**************************************************
      @return array

      Retourne tous les tests

 *************************************************/
    public function findAll()
    {
        $sql = "SELECT * FROM test ";

        $res = $this->getDb()->fetchAll($sql);

        $tests = array();
        foreach($res as $row){
            $_testID = $row['id_test'];
            $tests[$_testID] = $this->buildDomainObject($row);
        }

        return $tests;
    }

/**************************************************
      @return int

     Retourne le nombre total d'test

*************************************************/
    public function countAll()
    {
        $sql = "SELECT * FROM test ";

        $res = $this->getDb()->fetchAll($sql);

        $tests_total = array();
        foreach($res as $row){
            $_testID = $row['id_test'];
            $tests_total[$_testID] = $this->buildDomainObject($row);
        }

        return count($tests_total);
    }

/**************************************************
      @param Test $_test

      Fonction de sauvegarde d'un test

*************************************************/
    public function saveTest(Test $_test)
    {
        $test = array(
            'test_name'           => $_test->getTestName(),
            'coeff_test'          => $_test->getCoeffTest(),
            'date'                  => $_test->getDateTest(),
            'description'           => $_test->getDescriptionTest(),
            'semestre'              => $_test->getSemestre(),
            'id_class'              => $_test->getClass()->getIdClassName(),
       //     'id_competence'         => $_test->getCompetence()->getid_competence(),
            'dt_create'             => $_test->getDtCreate(),
            'dt_update'             => $_test->getDtUpdate(),
        );

        //on modifie
        if($_test->getid_test())
        {
            $this->getDb()->update('test', $test, array(
                'id_test'=> $_test->getid_test()));
        }
        //on sauvegarde
        else
        {
            $this->getDb()->insert('test', $test);
         //   $_id_test = $this->getDb()->lastInsertId();
         //   $_test->setid_test($_id_test);

        }
    }


/**************************************************

      @param $id_class

      Fonction de recherche d'un test en fonction de la classe

 *************************************************/

    public function findAllTestByClass($id_class)
    {
        $class = $this->classDAO->findClassname($id_class);

        $sql = "SELECT * FROM test WHERE id_class= ? ORDER BY id_test";
        $res = $this->getDb()->fetchAll($sql, array($id_class));

        $tests = array();
        foreach($res as $row)
        {
            $testID = $row['id_test'];
            $test = $this->buildDomainObject($row);
            $test->setClass($class);
            $tests[$testID] = $test;
        }

        return $tests;
    }

/**************************************************
      @param $id

      Suppression d'un test par l'id

*************************************************/
    public function deleteTest($id)
    {
        $this->getDb()->delete('test', array(
            'id_test' => $id
        ));
    }

/**************************************************

      @param $row
      @return Test

      Création de l'objet de la classe test

*************************************************/
    protected function buildDomainObject($row)
    {

        $test = new Test();
        $test->setId_Test($row['id_test']);
        $test->setDescription($row['description']);
     
     /*   $test->setTestName($row['test_name']);
        $test->setCoeffTest($row['coeff_test']);
        $test->setDateTest($row['date']);
   
        $test->setSemestre($row['semestre']);
        $test->setDtCreate($row['dt_create']);
        $test->setDtUpdate($row['dt_update']);
*/
        if (array_key_exists('id_class', $row))
        {
            $classID = $row['id_class'];
            $class = $this->classDAO->findClassname($classID);

            $test->setClass($class);
        }

    /*    if(array_key_exists('id_competence', $row))
        {
            $competenceID = $row['id_competence'];
            $competence = $this->competenceDAO->findCompetence($competenceID);

            $test->setCompetence($competence);
        }*/
        return $test;
    }

}