<?php

namespace freelancerppe\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use freelancerppe\Domain\Examen;
use freelancerppe\Domain\Evaluation;



class ExamenController {
 
    
    public function indexAction(Request $request ,Application $app)  {

        $examens = $app['dao.examen']->findAll();
        $classnames = $app['dao.className']->findAll();

        $date = date("d-m-Y");

        return $app['twig']->render('ListTemplate/examlist.html.twig', array(
            'examens' => $examens,
            'classname' => $classnames,
            'date' => $date,
        ));
      
    }

//************************************************
//               AFFICHE LISTE DES EXAMENS INDEX
//************************************************

     public function listIndexAction(Request $request ,Application $app)  {

         $examens = $app['dao.examen']->findAll();

         $classe = $app['dao.className']->findClassname($request->request->get('id_class'));

         $id_student = $request->request->get('id_student');
         $id_examen = $request->request->get('id_examen');

         $examen = $app['dao.examen']->findExamen($id_examen);
         $student = $app['dao.student']->findStudent($id_student);

         $date = date("d-m-Y");

         return $app['twig']->render('ListTemplate/notelist.html.twig', array(
             'examens' => $examens,
             'examen' => $examen,
             'student' => $student,
             'classe'   => $classe,
             'date' => $date,
         ));
     }

//************************************************
//              AFFICHE LISTE DES EXAMENS
//************************************************

     public function listAction(Request $request ,Application $app) {

         return $app['twig']->render('ListTemplate/examlist.html.twig');
    }



//************************************************
//
 //  FONCTION  AJOUT D'EXAMEN   INDEX
//
//************************************************

     //  //  Récupère via l'url les examens
    public function addIndexAction(Request $request ,Application $app) {
        $examens = $app['dao.examen']->findAll();
        $classes = $app['dao.className']->findAll();
        $disciplines = $app['dao.discipline']->findAll();

        return $app['twig']->render('FormTemplate/addexam.html.twig', array(

                'classes'            => $classes,
                'matieres'           => $disciplines,
                'examens'            => $examens,

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
        $coeff_examen = $request->request->get('coeff_examen');
        $class = $app['dao.className']->findClassname($request->request->get('classname'));
        $discipline = $app['dao.discipline']->findDiscipline($request->request->get('discipline'));
        $semestre = $request->request->get('semestre');
        $description = $request->request->get('description');

        $newExamen = new Examen();

        $newExamen->setExamenName($name);
        $newExamen->setCoeffExamen($coeff_examen);
        $newExamen->setDateExamen($date);
        $newExamen->setDescriptionExamen($description);
        $newExamen->setSemestre($semestre);
        $newExamen->setClass($class);
        $newExamen->setDiscipline($discipline);
        $newExamen->setDtCreate(date('Y-m-d H:i:s'));
        $newExamen->setDtUpdate(date('Y-m-d H:i:s'));

        $app['dao.examen']->saveExamen($newExamen);

        $app['session']->getFlashBag()->add('success', 'Examen ajouté avec succès !');

        return $this::indexAction($request, $app);
    }


//************************************************
//
//     FONCTIONS POUR L'EDITION   DES EXAMENS
//
//**********************************************/

    public function editExamenIndexAction(Request $request, Application $app) {

        $disciplines = $app['dao.discipline']->findAll();
        $classnames = $app['dao.className']->findAll();
        $examens = $app['dao.examen']->findAll();
        $id_examen = $request->request->get('id_examen');
        $examen =  $app['dao.examen']->findExamen($id_examen);

        return $app['twig']->render('FormTemplate/addexam.html.twig', array(
            'matieres'   => $disciplines,
            'classes'    => $classnames,
            'examen'     => $examen,
            'examens'    => $examens,
        ));
    }

    public function editExamenAction(Request $request, Application $app) {
        $examens = $app['dao.examen']->findAll();

        $name = $request->request->get('name');
        $id_examen = $request->request->get('id_examen');
        $coeff_examen = $request->request->get('coeff_examen');
        $date = $request->request->get('date');
        $description = $request->request->get('description');
        $semestre = $request->request->get('semestre');
        $class = $app['dao.className']->findClassname($request->request->get('classname'));
        $discipline = $app['dao.discipline']->findDiscipline($request->request->get('discipline'));


        $newExamen = new Examen();
        $newExamen->setIdExamen($id_examen);
        $newExamen->setExamenName($name);
        $newExamen->setCoeffExamen($coeff_examen);
        $newExamen->setSemestre($semestre);
        $newExamen->setDateExamen($date);
        $newExamen->setDescriptionExamen($description);
        $newExamen->setClass($class);
        $newExamen->setDiscipline($discipline);
        $newExamen->setDtUpdate(date('Y-m-d H:i:s'));

        $app['dao.examen']->saveExamen($newExamen);

        $app['session']->getFlashBag()->add('success', 'Examen Modifié avec succès !');

        return $this::indexAction($request, $app);
    }



//************************************************
//
//           FONCTIONS DE SUPPRESSION D' EXAMEN
//
//************************************************

    public function deleteExamenIndexAction(Request $request, Application $app) {

        $examens = $app['dao.examen']->findAll();

        $app['session']->getFlashBag()->add('danger', 'Examen supprimé !');

        return $app['twig']->render('ListTemplate/examlist.html.twig', array(
            'examens' => $examens,

        ));
    }

    public function deleteExamenAction(Request $request, Application $app){

        $id_examen = $request->request->get('id_examen');
        $newExamen = new Examen();

        $newExamen->setIdExamen($id_examen);

        $app['dao.examen']->deleteExamen($newExamen->getIdExamen());

        return $this::deleteExamenIndexAction($request, $app);

    }


}

