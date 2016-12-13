<?php

namespace freelancerppe\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
//use freelancerppe\Domain\Freelancer;
use freelancerppe\Domain\Projet;


class ProjetController {
    
    public function indexAction(Application $app)  {
        
        return $app['twig']->render('TabTemplate/classetab.html.twig');
    }
    
    // INDEX
     public function listIndexAction(Application $app)  {

         $projets = $app['dao.projet']->findAll();
         $users = $app['dao.user']->findAll();

         $ProjetByFreelancer = array();

         foreach($projets as $class)
         {
             $id = $class->getId_Projet();//on recupère l'id du projet courante
         //    $total = $app['dao.projet']->countProjetByFreelancer($id);//on récupère la valeur dans une variable
      //       $ProjetByFreelancer[$id] = $total;//on ajoute dans le tableau...
         }

         return $app['twig']->render('ListTemplate/projetslist.html.twig', array(
             'projets'              => $projets,
       //      'ProjetByFreelancer'       => $ProjetByFreelancer,
             'users'                => $users,
         ));
     }

     // AJOUT INDEX
    public function addIndexAction(Application $app) {

        $projets = $app['dao.projet']->findAll();

        return $app['twig']->render('FormTemplate/addprojet.html.twig', array(
            'projets' => $projets
        ));
         
    }
    
    // AJOUT TRAITEMENT
    public function addAction(Request $request ,Application $app)
    {

        $newClass = new Projet();

        if (null !== $request->request->get('id_class')) {
            $newClass->setid_projet($request->request->get('id_class'));
            $newClass->setDtCreate($newClass->getDtCreate());
        }

        $newClass->setProjet($request->request->get('class_name'));
        $newClass->setClassType($request->request->get('class_type'));
        $newClass->setClassOption($request->request->get('option'));
        $newClass->setClassYear($request->request->get('year'));
        $newClass->setDescription($request->request->get('description'));
        $newClass->setDtCreate('Y-m-d H:i:s');
        $newClass->setDtUpdate(date('Y-m-d H:i:s'));

        $app['dao.projet']->saveProjet($newClass);

        if (null !== $request->request->get('id_class')) {
            $app['session']->getFlashBag()->add('success', 'Le projet a été modifié avec succès !');

            return $app->redirect($app['url_generator']->generate('projetslist'));
        }
        else {
            $app['session']->getFlashBag()->add('success', 'Le projet a été ajouté avec succès !');

            return $app->redirect($app['url_generator']->generate('projetslist'));
        }
    }

    public function deleteProjetIndexAction(Request $request, Application $app)
    {
        $id_projet = $request->request->get('id_proejt');
     //   $id_projets = $request->request->get('id_studentclass');

        $newClass = new Projet();

        $newClass->setid_projet($id_projet);

        $app['dao.projet']->deleteclassName($newClass->getid_projet());

        $app['session']->getFlashBag()->add('danger', 'Le projet a été supprimé !');

        $projets = $app['dao.projet']->findAll();

        return $app['twig']->render('ListTemplate/projetslist.html.twig', array(
            'projet' => $projets,
        ));
    }

    public function deleteProjetAction(Request $request, Application $app)
    {
        $id_projets = $request->request->get('id_studentclass');

       // $projets = $app['dao.student']->findAllProjetByFreelancer($id_projets);

        $newClass = new Projet();

        $newClass->setid_projet($id_projets);

        $app['dao.projet']->deleteclassName($newClass->getid_projet());

        $app['session']->getFlashBag()->add('danger', 'Le projet a été supprimé !');

        // Redirecton vers la liste des projets
        return $app->redirect($app['url_generator']->generate('projetslist'));
    }

    //MODIFICATION
    public function editProjetAction(Request $request, Application $app)
    {
        $id_class = $request->request->get('id_class');

        $projet = $app['dao.projet']->findProjet($id_class);

        return $app['twig']->render('FormTemplate/addprojet.html.twig', array(
            'projet' => $projet,
        ));
    }

    //Affichage de la liste des étudiants par classe
    public function listStudentIndexAction(Request $request, Application $app)
    {
        $projets = $app['dao.projet']->findAll();

        $id_class = $request->request->get('id_studentclass');

        $classe = $app['dao.projet']->findClassname($id_class);

      //  $projets = $app['dao.student']->findAllProjetByFreelancer($id_class); //tous les étudiants de la classe en param

        return $app['twig']->render('ListTemplate/studentByClass.html.twig', array(
            'allStudents'   => $projets,
            'classe'        => $classe,
            'projets'       => $projets,
        ));
    }

    //Action sur la modification des freelancer
   /* public function updateStudentAction(Request $request, Application $app)
    {
        $id_student = $request->request->get('id_student');

        $student = $app['dao.student']->findStudent($id_student);
        $projets = $app['dao.projet']->findAll();
        $statuts = $app['dao.statutStudent']->findAll();

        return $app['twig']->render('FormTemplate/addstudent.html.twig', array(
            'student' => $student,
            'projets' => $projets,
            'statuts' => $statuts,
        ));
    }*/
}

