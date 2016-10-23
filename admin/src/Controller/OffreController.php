<?php

namespace freelancerppe\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use freelancerppe\Domain\Offre;

Class OffreController {
 
    
    public function indexAction(Application $app)  {

        $offres = $app['dao.offre']->findAll();
        $projets = $app['dao.projet']->findAll();

        $date = date("d-m-Y");

        return $app['twig']->render('ListTemplate/offreslist.html.twig', array(
            'offres' => $offres,
            'projets' => $projets,
            'date' => $date,
        ));
      
    }

//************************************************
//               AFFICHE LISTE DES EXAMENS INDEX
//************************************************
/*
     public function listIndexAction(Request $request ,Application $app)  {

         $offres = $app['dao.offre']->findAll();

         $projet = $app['dao.projet']->findProjet($request->request->get('id_projet'));

         $id_freelancer = $request->request->get('id_freelancer');
         $id_offre = $request->request->get('id_offre');

         $offre = $app['dao.offre']->findOffre($id_offre);
         $freelancer = $app['dao.freelancer']->findStudent($id_freelancer);

         $date = date("d-m-Y");

         return $app['twig']->render('ListTemplate/notelist.html.twig', array(
             'offres' => $offres,
             'offre' => $offre,
             'freelancer' => $freelancer,
             'projet'   => $projet,
             'date' => $date,
         ));
     }
*/
//************************************************
//              AFFICHE LISTE DES OFFRES
//************************************************

     public function listAction(Application $app) {

         return $app['twig']->render('ListTemplate/offreslist.html.twig');
    }



//************************************************
//
 //  FONCTION  AJOUT D'OFFRE   INDEX
//
//************************************************

     //  //  Récupère via l'url les offres
    public function addIndexAction(Application $app) {
        $offres = $app['dao.offre']->findAll();
        $projets = $app['dao.projet']->findAll();
        $competences = $app['dao.competence']->findAll();

        return $app['twig']->render('FormTemplate/addoffre.html.twig', array(

                'projets'            => $projets,
                'competences'           => $competences,
                'offres'            => $offres,

            )

        );
    }

//************************************************
//  FONCTION AJOUT D'OFFRE   -> TRAITEMENT
//************************************************

     // Récupère les données en post et insère en base de données
    
    public function addAction(Request $request ,Application $app) {

        $name = $request->request->get('name');
        $date = $request->request->get('date');
        $coeff_offre = $request->request->get('coeff_offre');
        $projet = $app['dao.projet']->findProjet($request->request->get('projets'));
        $competence = $app['dao.competence']->findCompetence($request->request->get('competence'));
      
        $description = $request->request->get('description');

        $newOffre = new Offre();

        $newOffre->setId_offre($name);
   /*     $newOffre->setCoeffOffre($coeff_offre);
        $newOffre->setDateOffre($date);
        $newOffre->setDescriptionOffre($description);
        $newOffre->setClass($projet);
        $newOffre->setCompetence($competence);
        $newOffre->setDtCreate(date('Y-m-d H:i:s'));
        $newOffre->setDtUpdate(date('Y-m-d H:i:s'));
*/
        $app['dao.offre']->saveOffre($newOffre);

        $app['session']->getFlashBag()->add('success', 'Offre ajouté avec succès !');

        return $this::indexAction($request, $app);
    }


//************************************************
//
//     FONCTIONS POUR L'EDITION DES TESTS
//
//**********************************************/

    public function editOffreIndexAction(Request $request, Application $app) {

        $competences = $app['dao.competence']->findAll();
        $projets = $app['dao.projet']->findAll();
        $offres = $app['dao.offre']->findAll();
        $id_offre = $request->request->get('id_offre');
        $offre =  $app['dao.offre']->findOffre($id_offre);

        return $app['twig']->render('FormTemplate/addoffre.html.twig', array(
            'competences'   => $competences,
            'projets'    => $projets,
            'offre'     => $offre,
            'offres'    => $offres,
        ));
    }

    public function editOffreAction(Request $request, Application $app) {
        $offres = $app['dao.offre']->findAll();

        $name = $request->request->get('name');
        $id_offre = $request->request->get('id_offre');
        $coeff_offre = $request->request->get('coeff_offre');
        $date = $request->request->get('date');
        $description = $request->request->get('description');

        $projet = $app['dao.projet']->findProjet($request->request->get('projets'));
        $competence = $app['dao.competence']->findCompetence($request->request->get('competence'));


        $newOffre = new Offre();
        $newOffre->setIdOffre($id_offre);
        $newOffre->setOffreName($name);
        $newOffre->setCoeffOffre($coeff_offre);
 
        $newOffre->setDateOffre($date);
        $newOffre->setDescriptionOffre($description);
        $newOffre->setClass($projet);
        $newOffre->setCompetence($competence);
        $newOffre->setDtUpdate(date('Y-m-d H:i:s'));

        $app['dao.offre']->saveOffre($newOffre);

        $app['session']->getFlashBag()->add('success', 'Offre modifié avec succès !');

        return $this::indexAction($request, $app);
    }



//************************************************
//
//           FONCTIONS DE SUPPRESSION DE TEST
//
//************************************************

    public function deleteOffreIndexAction(Application $app) {

        $offres = $app['dao.offre']->findAll();

        $app['session']->getFlashBag()->add('danger', 'Offre supprimé !');

        return $app['twig']->render('ListTemplate/offreslist.html.twig', array(
            'offres' => $offres,

        ));
    }

    public function deleteOffreAction(Request $request, Application $app){

        $id_offre = $request->request->get('id_offre');
        $newOffre = new Offre();

        $newOffre->setIdOffre($id_offre);

        $app['dao.offre']->deleteOffre($newOffre->getIdOffre());

        return $this::deleteOffreIndexAction($request, $app);

    }


}

