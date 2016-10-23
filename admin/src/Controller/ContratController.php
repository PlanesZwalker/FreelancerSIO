<?php

namespace freelancerppe\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use freelancerppe\Domain\Contrat;

class ContratController {
    
    public function indexAction(Application $app)  {

        $contrats = $app['dao.contrat']->findAll();
        $projets = $app['dao.projet']->findAll();

        $date = date("d-m-Y");

        return $app['twig']->render('ListTemplate/contratslist.html.twig', array(
            'contrats' => $contrats,
            'projets' => $projets,
            'date' => $date,
        )); 
    }

//************************************************
//               AFFICHE LISTE DES EXAMENS INDEX
//************************************************

     public function listIndexAction(Request $request ,Application $app)  {

         $contrats = $app['dao.contrat']->findAll();

         $projet = $app['dao.projet']->findProjet($request->request->get('id_class'));

         $id_freelancer = $request->request->get('id_freelancer');
         $id_contrat = $request->request->get('id_contrat');

         $contrat = $app['dao.contrat']->findContrat($id_contrat);
         $freelancer = $app['dao.freelancer']->findStudent($id_freelancer);

         $date = date("d-m-Y");

         return $app['twig']->render('ListTemplate/notelist.html.twig', array(
             'contrats' => $contrats,
             'contrat' => $contrat,
             'freelancer' => $freelancer,
             'projet'   => $projet,
             'date' => $date,
         ));
     }

//************************************************
//              AFFICHE LISTE DES EXAMENS
//************************************************

     public function listAction(Application $app) {

         return $app['twig']->render('ListTemplate/contratslist.html.twig');
    }



//************************************************
//
 //  FONCTION  AJOUT D'EXAMEN   INDEX
//
//************************************************

     //  //  Récupère via l'url les contrats
    public function addIndexAction(Application $app) {
        $contrats = $app['dao.contrat']->findAll();
        $projets = $app['dao.projet']->findAll();
        $competences = $app['dao.competence']->findAll();

        return $app['twig']->render('FormTemplate/addcontrat.html.twig', array(

                'projets'            => $projets,
                'competences'           => $competences,
                'contrats'            => $contrats,

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
        $coeff_contrat = $request->request->get('coeff_contrat');
        $class = $app['dao.projet']->findProjet($request->request->get('projets'));
        $competence = $app['dao.competence']->findCompetence($request->request->get('competence'));
      
        $description = $request->request->get('description');

        $newContrat = new Contrat();

        $newContrat->setContratName($name);
        $newContrat->setCoeffContrat($coeff_contrat);
        $newContrat->setDateContrat($date);
        $newContrat->setDescriptionContrat($description);
        $newContrat->setClass($class);
        $newContrat->setCompetence($competence);
        $newContrat->setDtCreate(date('Y-m-d H:i:s'));
        $newContrat->setDtUpdate(date('Y-m-d H:i:s'));

        $app['dao.contrat']->saveContrat($newContrat);

        $app['session']->getFlashBag()->add('success', 'Contrat ajouté avec succès !');

        return $this::indexAction($request, $app);
    }


//************************************************
//
//     FONCTIONS POUR L'EDITION DES CONTRATS
//
//**********************************************/

    public function editContratIndexAction(Request $request, Application $app) {

        $competences = $app['dao.competence']->findAll();
        $projets = $app['dao.projet']->findAll();
        $contrats = $app['dao.contrat']->findAll();
        $id_contrat = $request->request->get('id_contrat');
        $contrat =  $app['dao.contrat']->findContrat($id_contrat);

        return $app['twig']->render('FormTemplate/addcontrat.html.twig', array(
            'competences'   => $competences,
            'projets'    => $projets,
            'contrat'     => $contrat,
            'contrats'    => $contrats,
        ));
    }

    public function editContratAction(Request $request, Application $app) {
        $contrats = $app['dao.contrat']->findAll();

        $name = $request->request->get('name');
        $id_contrat = $request->request->get('id_contrat');
        $coeff_contrat = $request->request->get('coeff_contrat');
        $date = $request->request->get('date');
        $description = $request->request->get('description');

        $class = $app['dao.projet']->findProjet($request->request->get('projets'));
        $competence = $app['dao.competence']->findCompetence($request->request->get('competence'));


        $newContrat = new Contrat();
        $newContrat->setIdContrat($id_contrat);
        $newContrat->setContratName($name);
        $newContrat->setCoeffContrat($coeff_contrat);
 
        $newContrat->setDateContrat($date);
        $newContrat->setDescriptionContrat($description);
        $newContrat->setClass($class);
        $newContrat->setCompetence($competence);
        $newContrat->setDtUpdate(date('Y-m-d H:i:s'));

        $app['dao.contrat']->saveContrat($newContrat);

        $app['session']->getFlashBag()->add('success', 'Contrat modifié avec succès !');

        return $this::indexAction($request, $app);
    }



//************************************************
//
//           FONCTIONS DE SUPPRESSION DE TEST
//
//************************************************

    public function deleteContratIndexAction(Application $app) {

        $contrats = $app['dao.contrat']->findAll();

        $app['session']->getFlashBag()->add('danger', 'Contrat supprimé !');

        return $app['twig']->render('ListTemplate/contratslist.html.twig', array(
            'contrats' => $contrats,

        ));
    }

    public function deleteContratAction(Request $request, Application $app){

        $id_contrat = $request->request->get('id_contrat');
        $newContrat = new Contrat();

        $newContrat->setIdContrat($id_contrat);

        $app['dao.contrat']->deleteContrat($newContrat->getIdContrat());

        return $this::deleteContratIndexAction($request, $app);

    }


}

