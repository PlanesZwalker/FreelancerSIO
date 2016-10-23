<?php

namespace freelancerppe\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use freelancerppe\Domain\Cahierdescharges;
use freelancerppe\Domain\Contrat;
use freelancerppe\Domain\Projet;

class CahierdeschargesController {
    
    public function indexAction(Application $app)  {

        $cahierdescharges = $app['dao.cahierdescharges']->findAll();
        $projets = $app['dao.projet']->findAll();

        $date = date("d-m-Y");

        return $app['twig']->render('ListTemplate/cahierdeschargeslist.html.twig', array(
            'cahierdescharges' => $cahierdescharges,
            'projets' => $projets,
            'date' => $date,
        )); 
    }

//************************************************
//               AFFICHE LISTE DES CAHIER DES CHARGES INDEX
//************************************************

     public function listIndexAction(Request $request ,Application $app)  {

         $cahierdescharges = $app['dao.cahierdescharges']->findAll();

         $projet = $app['dao.projet']->findProjet($request->request->get('id_class'));

         $id_freelancer = $request->request->get('id_freelancer');
         $id_cahierdescharges = $request->request->get('id_cahierdescharges');

         $cahierdescharges = $app['dao.cahierdescharges']->findCahierdescharges($id_cahierdescharges);
         $freelancer = $app['dao.freelancer']->findStudent($id_freelancer);

         $date = date("d-m-Y");

         return $app['twig']->render('ListTemplate/notelist.html.twig', array(
             'cahierdescharges' => $cahierdescharges,
             'cahierdescharges' => $cahierdescharges,
             'freelancer' => $freelancer,
             'projet'   => $projet,
             'date' => $date,
         ));
     }

//************************************************
//              AFFICHE LISTE DES CAHIER DES CHARGES
//************************************************

     public function listAction(Application $app) {

         return $app['twig']->render('ListTemplate/cahierdeschargeslist.html.twig');
    }



//************************************************
//
 //  FONCTION  AJOUT D'CAHIER DES CHARGES   INDEX
//
//************************************************

     //  //  Récupère via l'url les cahierdescharges
    public function addIndexAction(Application $app) {
        $cahierdescharges = $app['dao.cahierdescharges']->findAll();
        $projets = $app['dao.projet']->findAll();
        $competences = $app['dao.competence']->findAll();

        return $app['twig']->render('FormTemplate/addcahierdescharges.html.twig', array(

                'projets'            => $projets,
                'competences'           => $competences,
                'cahierdescharges'            => $cahierdescharges,

            )

        );
    }

//************************************************
//  FONCTION AJOUT D'CAHIER DES CHARGES    TRAITEMENT
//************************************************

     // Récupère les données en post et insère en base de données
    
    public function addAction(Request $request ,Application $app) {

        $name = $request->request->get('name');
        $date = $request->request->get('date');
        $coeff_cahierdescharges = $request->request->get('coeff_cahierdescharges');
        $class = $app['dao.projet']->findProjet($request->request->get('projets'));
        $competence = $app['dao.competence']->findCompetence($request->request->get('competence'));
      
        $description = $request->request->get('description');

        $newCahierdescharges = new Cahierdescharges();

        $newCahierdescharges->setCahierdeschargesName($name);
        $newCahierdescharges->setCoeffCahierdescharges($coeff_cahierdescharges);
        $newCahierdescharges->setDateCahierdescharges($date);
        $newCahierdescharges->setDescriptionCahierdescharges($description);
        $newCahierdescharges->setClass($class);
        $newCahierdescharges->setCompetence($competence);
        $newCahierdescharges->setDtCreate(date('Y-m-d H:i:s'));
        $newCahierdescharges->setDtUpdate(date('Y-m-d H:i:s'));

        $app['dao.cahierdescharges']->saveCahierdescharges($newCahierdescharges);

        $app['session']->getFlashBag()->add('success', 'Cahierdescharges ajouté avec succès !');

        return $this::indexAction($request, $app);
    }


//************************************************
//
//     FONCTIONS POUR L'EDITION DES CAHIER DES CHARGES
//
//**********************************************/

    public function editCahierdeschargesIndexAction(Request $request, Application $app) {

        $competences = $app['dao.competence']->findAll();
        $projets = $app['dao.projet']->findAll();
        $cahierdescharges = $app['dao.cahierdescharges']->findAll();
        $id_cahierdescharges = $request->request->get('id_cahierdescharges');
        $cahierdescharges =  $app['dao.cahierdescharges']->findCahierdescharges($id_cahierdescharges);

        return $app['twig']->render('FormTemplate/addcahierdescharges.html.twig', array(
            'competences'   => $competences,
            'projets'    => $projets,
            'cahierdescharges'     => $cahierdescharges,
            'cahierdescharges'    => $cahierdescharges,
        ));
    }

    public function editCahierdeschargesAction(Request $request, Application $app) {
        $cahierdescharges = $app['dao.cahierdescharges']->findAll();

        $name = $request->request->get('name');
        $id_cahierdescharges = $request->request->get('id_cahierdescharges');
        $coeff_cahierdescharges = $request->request->get('coeff_cahierdescharges');
        $date = $request->request->get('date');
        $description = $request->request->get('description');

        $class = $app['dao.projet']->findProjet($request->request->get('projets'));
        $competence = $app['dao.competence']->findCompetence($request->request->get('competence'));


        $newCahierdescharges = new Cahierdescharges();
        $newCahierdescharges->setIdCahierdescharges($id_cahierdescharges);
        $newCahierdescharges->setCahierdeschargesName($name);
        $newCahierdescharges->setCoeffCahierdescharges($coeff_cahierdescharges);
 
        $newCahierdescharges->setDateCahierdescharges($date);
        $newCahierdescharges->setDescriptionCahierdescharges($description);
        $newCahierdescharges->setClass($class);
        $newCahierdescharges->setCompetence($competence);
        $newCahierdescharges->setDtUpdate(date('Y-m-d H:i:s'));

        $app['dao.cahierdescharges']->saveCahierdescharges($newCahierdescharges);

        $app['session']->getFlashBag()->add('success', 'Cahierdescharges modifié avec succès !');

        return $this::indexAction($request, $app);
    }



//************************************************
//
//           FONCTIONS DE SUPPRESSION DE CAHIER DES CHARGES
//
//************************************************

    public function deleteCahierdeschargesIndexAction(Application $app) {

        $cahierdescharges = $app['dao.cahierdescharges']->findAll();

        $app['session']->getFlashBag()->add('danger', 'Cahierdescharges supprimé !');

        return $app['twig']->render('ListTemplate/cahierdeschargeslist.html.twig', array(
            'cahierdescharges' => $cahierdescharges,

        ));
    }

    public function deleteCahierdeschargesAction(Request $request, Application $app){

        $id_cahierdescharges = $request->request->get('id_cahierdescharges');
        $newCahierdescharges = new Cahierdescharges();

        $newCahierdescharges->setIdCahierdescharges($id_cahierdescharges);

        $app['dao.cahierdescharges']->deleteCahierdescharges($newCahierdescharges->getIdCahierdescharges());

        return $this::deleteCahierdeschargesIndexAction($request, $app);

    }


}

