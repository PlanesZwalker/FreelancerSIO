<?php

namespace freelancerppe\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use freelancerppe\Domain\Test;

class TestController {
 
    
    public function indexAction(Application $app)  {

        $tests = $app['dao.test']->findAll();
        $projets = $app['dao.projet']->findAll();

        $date = date("d-m-Y");

        return $app['twig']->render('ListTemplate/testslist.html.twig', array(
            'tests' => $tests,
            'projets' => $projets,
            'date' => $date,
        ));
      
    }

//************************************************
//               AFFICHE LISTE DES EXAMENS INDEX
//************************************************

     public function listIndexAction(Request $request ,Application $app)  {

         $tests = $app['dao.test']->findAll();

         $projet = $app['dao.projet']->findProjet($request->request->get('id_class'));

         $id_freelancer = $request->request->get('id_freelancer');
         $id_test = $request->request->get('id_test');

         $test = $app['dao.test']->findTest($id_test);
         $freelancer = $app['dao.freelancer']->findStudent($id_freelancer);

         $date = date("d-m-Y");

         return $app['twig']->render('ListTemplate/notelist.html.twig', array(
             'tests' => $tests,
             'test' => $test,
             'freelancer' => $freelancer,
             'projet'   => $projet,
             'date' => $date,
         ));
     }

//************************************************
//              AFFICHE LISTE DES EXAMENS
//************************************************

     public function listAction(Application $app) {

         return $app['twig']->render('ListTemplate/testslist.html.twig');
    }



//************************************************
//
 //  FONCTION  AJOUT D'EXAMEN   INDEX
//
//************************************************

     //  //  Récupère via l'url les tests
    public function addIndexAction(Application $app) {
        $tests = $app['dao.test']->findAll();
        $projets = $app['dao.projet']->findAll();
        $competences = $app['dao.competence']->findAll();

        return $app['twig']->render('FormTemplate/addtest.html.twig', array(

                'projets'            => $projets,
                'competences'           => $competences,
                'tests'            => $tests,

            )

        );
    }

//************************************************
//  FONCTION AJOUT D'EXAMEN    TRAITEMENT
//************************************************

     // Récupère les données en post et insère en base de données
    
    public function addAction(Request $request ,Application $app) {

        $name = $request->request->get('name');
        $date = $request->request->get('date');
        $coeff_test = $request->request->get('coeff_test');
        $class = $app['dao.projet']->findProjet($request->request->get('projets'));
        $competence = $app['dao.competence']->findCompetence($request->request->get('competence'));
      
        $description = $request->request->get('description');

        $newTest = new Test();

        $newTest->setTestName($name);
        $newTest->setCoeffTest($coeff_test);
        $newTest->setDateTest($date);
        $newTest->setDescriptionTest($description);
        $newTest->setClass($class);
        $newTest->setCompetence($competence);
        $newTest->setDtCreate(date('Y-m-d H:i:s'));
        $newTest->setDtUpdate(date('Y-m-d H:i:s'));

        $app['dao.test']->saveTest($newTest);

        $app['session']->getFlashBag()->add('success', 'Test ajouté avec succès !');

        return $this::indexAction($request, $app);
    }


//************************************************
//
//     FONCTIONS POUR L'EDITION DES TESTS
//
//**********************************************/

    public function editTestIndexAction(Request $request, Application $app) {

        $competences = $app['dao.competence']->findAll();
        $projets = $app['dao.projet']->findAll();
        $tests = $app['dao.test']->findAll();
        $id_test = $request->request->get('id_test');
        $test =  $app['dao.test']->findTest($id_test);

        return $app['twig']->render('FormTemplate/addtest.html.twig', array(
            'competences'   => $competences,
            'projets'    => $projets,
            'test'     => $test,
            'tests'    => $tests,
        ));
    }

    public function editTestAction(Request $request, Application $app) {
        $tests = $app['dao.test']->findAll();

        $name = $request->request->get('name');
        $id_test = $request->request->get('id_test');
        $coeff_test = $request->request->get('coeff_test');
        $date = $request->request->get('date');
        $description = $request->request->get('description');

        $class = $app['dao.projet']->findProjet($request->request->get('projets'));
        $competence = $app['dao.competence']->findCompetence($request->request->get('competence'));


        $newTest = new Test();
        $newTest->setIdTest($id_test);
        $newTest->setTestName($name);
        $newTest->setCoeffTest($coeff_test);
 
        $newTest->setDateTest($date);
        $newTest->setDescriptionTest($description);
        $newTest->setClass($class);
        $newTest->setCompetence($competence);
        $newTest->setDtUpdate(date('Y-m-d H:i:s'));

        $app['dao.test']->saveTest($newTest);

        $app['session']->getFlashBag()->add('success', 'Test modifié avec succès !');

        return $this::indexAction($request, $app);
    }



//************************************************
//
//           FONCTIONS DE SUPPRESSION DE TEST
//
//************************************************

    public function deleteTestIndexAction(Application $app) {

        $tests = $app['dao.test']->findAll();

        $app['session']->getFlashBag()->add('danger', 'Test supprimé !');

        return $app['twig']->render('ListTemplate/testslist.html.twig', array(
            'tests' => $tests,

        ));
    }

    public function deleteTestAction(Request $request, Application $app){

        $id_test = $request->request->get('id_test');
        $newTest = new Test();

        $newTest->setIdTest($id_test);

        $app['dao.test']->deleteTest($newTest->getIdTest());

        return $this::deleteTestIndexAction($request, $app);

    }


}

