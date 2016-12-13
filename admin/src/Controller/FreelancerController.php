<?php

namespace freelancerppe\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use freelancerppe\Domain\Freelancer;
use freelancerppe\Domain\User;

/**
 * Description of FreelancerController
 *
 * @author ajj
 */
class FreelancerController
{

//************************************************
//                     INDEX
//**********************************************/

    public function indexAction(Application $app)
    {
        return $app['twig']->render('TabTemplate/freelancertab.html.twig');
    }

//************************************************
    //                   LISTE
//**********************************************/

    public function listIndexAction(Request $request, Application $app)
    {

        $freelancers = $app['dao.freelancer']->findAll();

        return $app['twig']->render('ListTemplate/freelancerslist.html.twig', array(
            'freelancers' => $freelancers,
        ));
    }

//************************************************
//         FONCTIONS D'AJOUT DE FREELANCER
//**********************************************/

    public function addIndexAction(Application $app)
    {
        $competences = $app['dao.competence']->findAll();
        
        return $app['twig']->render('FormTemplate/addfreelancer.html.twig', array(

            'competences'  => $competences
        ));
    }


    public function addAction(Request $request, Application $app)
    {
        $newFreelancer = new Freelancer();

        if (null !== $request->request->get('id_freelancer')) {
            $newFreelancer->setid_freelancer($request->request->get('id_freelancer'));
        }

        $newFreelancer->setPseudo($request->request->get('pseudo'));
        $newFreelancer->setNomuser($request->request->get('nomuser')); 
        $newFreelancer->setPrenomuser($request->request->get('prenomuser'));
        $newFreelancer->setAdresse($request->request->get('adresse'));
        $newFreelancer->setTelephone($request->request->get('telephone'));
        $newFreelancer->setEmail($request->request->get('email'));
        $newFreelancer->setDate_insc(date('Y-m-d H:i:s'));
        $newFreelancer->setDate_modif(date('Y-m-d H:i:s'));

        $app['dao.freelancer']->saveFreelancer($newFreelancer);

        if (null !== $request->request->get('id_freelancer')) {
            $app['session']->getFlashBag()->add('success', 'Le Freelancer a bien été modifié !'); //message flash success si réussi

            return $app->redirect($app['url_generator']->generate('freelancerslist'));
        } else {
            $app['session']->getFlashBag()->add('success', 'Le Freelancer a bien été ajouté !'); //message flash success si réussi

            return $app->redirect($app['url_generator']->generate('freelancerslist'));
        }
    }

//************************************************
//     FONCTIONS POUR L'EDITION DES ETUDIANTS
//**********************************************/

    public function editFreelancerIndexAction(Request $request, Application $app)
    {
        $id_freelancer = $request->request->get('id_freelancer');

        $freelancer = $app['dao.freelancer']->findFreelancer($id_freelancer);

        return $app['twig']->render('FormTemplate/addfreelancer.html.twig', array(
            'freelancer' => $freelancer,
        ));
    }

//************************************************
//             FONCTIONS DE SUPPRESSION
//**********************************************/

    public function deleteFreelancerIndexAction(Application $app)
    {
        $freelancers = $app['dao.freelancer']->findAll();

        $app['session']->getFlashBag()->add('danger', 'Freelancer supprimé !');

        return $app['twig']->render('ListTemplate/freelancerslist.html.twig', array(
            'freelancers' => $freelancers,
        ));
    }

    public function deleteFreelancerAction(Request $request, Application $app)
    {
        $id_freelancer = $request->request->get('id_freelancer');
        $newFreelancer = new Freelancer();
        $newFreelancer->setid_freelancer($id_freelancer);

        $app['dao.freelancer']->deleteFreelancer($newFreelancer->getid_freelancer());

        return $this::deleteFreelancerIndexAction($request, $app);

    }

//************************************************
//      FONCTIONS POUR LES  STATISTIQUES
//**********************************************/
    /*
    public function freelancerStatIndex(Request $request, Application $app)
    {
        $id_freelancer = $request->request->get('id_freelancer');

        $freelancers = $app['dao.freelancer']->findAll();;

        return $app['twig']->render('StatTemplate/freelancerstats.html.twig', array(
            'freelancers'      => $freelancers,

        ));
    }

    public function statByFreelancerIndexAction(Request $request, Application $app)
    {
        $id_freelancer = $request->request->get('id_freelancer');

        $id_class = $request->request->get('id_class');

        $freelancers = $app['dao.freelancer']->findAll();
        $evaluation = $app['dao.evaluation']->findAll();
        $discipline = $app['dao.discipline']->findAll();
        
        $examen = $app['dao.examen']->findAllExamenByClass($id_class);

        $freelancer = $app['dao.freelancer']->findFreelancer($id_freelancer);

        $evaluationByFreelancer = $app['dao.evaluation']->findEvalByFreelancer($id_freelancer);

        return $app['twig']->render('StatTemplate/statByFreelancer.html.twig', array(
            'freelancer'       => $freelancer,
            'evaluationByFreelancer' => $evaluationByFreelancer,
            'examenAll' => $examen,
            'matiere' => $discipline

        ));
    }

*/
}
