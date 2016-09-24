<?php

namespace freelancerppe\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use freelancerppe\Domain\Evaluation;


class EvaluationController {



//************************************************
     // AJOUT INDEX
//************************************************

    public function addIndexAction(Request $request ,Application $app) {

        $classes = $app['dao.className']->findAll();
        $discipline = $app['dao.discipline']->findAll();
        $students = $app['dao.student']->findAll();
        $examens = $app['dao.examen']->findAll();

        $id_class = $request->request->get('id_class');
        $judgment = $request->request->get('judgment');
        $id_examen = $request->request->get('id_examen');
        $id_evaluation = $request->request->get('id_evaluation');

        $exam = $app['dao.examen']->findExamen($id_examen);
        $taclasse = $app['dao.className']->findClassname($id_class);
        $studentbyclass = $app['dao.student']->findAllStudentByClass($id_class);


        return $app['twig']->render('ListTemplate/notelist.html.twig', array(
                'classNames' => $classes,
                'taclasse' => $taclasse,
                'matieres' => $discipline,
                'students' => $students,
                'examens' => $examens,
                'examen'    => $exam,
                'judgment' => $judgment,
                'studentbyclass' => $studentbyclass,
            )
       );
    }

//************************************************
    // AJOUT TRAITEMENT
//************************************************

    public function addAction(Request $request ,Application $app) {

        $param = $request->request->all();

        $id_examen = $request->request->get('id_examen');
        $judgment = $request->request->get('judgment');

        $notes = $request->request->get('note_student');

        $ids_student = $request->request->get('id_student');

        $nbr_etud = $param['note_student'];
        $nombreNoteEtudiant = sizeof($nbr_etud);

        for($i=0; $i<$nombreNoteEtudiant; $i++)
        {
                $newEvaluation = new Evaluation();

                $newEvaluation->setGradeStudent($notes[$i]);
                $newEvaluation->setJudgement($judgment[$i]);
                $newEvaluation->setDtCreate(date('Y-m-d H:i:s'));
                $newEvaluation->setDtUpdate(date('Y-m-d H:i:s'));
                $newEvaluation->setIdExamen($id_examen);
                $newEvaluation->setIdStudent($ids_student[$i]);

                $app['dao.evaluation']->saveGrade($newEvaluation);
        }

        //On charge les dao nécessaires
        $examens = $app['dao.examen']->findAll();
        $classnames = $app['dao.className']->findAll();
        $date = date("d-m-Y");

        $app['session']->getFlashBag()->add('success', 'Les notes ont bien été enregistrées !');

        return $app['twig']->render('ListTemplate/examlist.html.twig', array(
                'classname' => $classnames,
                'examens'   => $examens,
                'date'      => $date,

              )
         );
    }


//************************************************
     // TABLEAU DE BORD
//************************************************

     public function tabAction(Request $request ,Application $app) {    
  
           return $app['twig']->render('StatTemplate/notestats.html.twig');
    }


//************************************************
    // LISTE
//************************************************

     public function listAction(Request $request ,Application $app) {

         $disciplines = $app['dao.discipline']->findAll();
         $student = $app['dao.student']->findAll();
         $examens = $app['dao.examen']->findAll();

         $examen = $app['dao.examen']->findExamen($examens->getExamen()->getIdExamen());

         return $app['twig']->render('ListTemplate/notelist.html.twig', array(
                 'matieres' => $disciplines,
                 'students' => $student,
                 'examen' => $examen,
             )
         );
    }
   
//************************************************
//      FONCTIONS POUR LES  STATISTIQUES
//**********************************************/

    public function statAction(Request $request ,Application $app) {

        $param = $request->request->all();

        $id_student = $request->request->get('id_student');

        $classes = $app['dao.className']->findAll();
        $disciplines = $app['dao.discipline']->findAll();
        $students = $app['dao.student']->findAll();
        $examens = $app['dao.examen']->findAll();
        $evaluations = $app['dao.evaluation']->findAll();

        $evaluationStudent = $app['dao.evaluation']->findEvalByStudent($id_student);
        $averageByStudent = $app['dao.evaluation']->findEvalByStudent($id_student);

        $student = $app['dao.student']->findStudent($id_student);

        return $app['twig']->render('StatTemplate/notestats.html.twig', array(

            'classname'     => $classes,
            'examens'       => $examens,
            'evaluations'   => $evaluations,
            'students'      => $students ,
            'student'       => $student ,
            'disciplines'   => $disciplines,
            'evaluationStudent' => $evaluationStudent,
            'param'         => $param,
        ));
    }
//*****************************************************************
//      FONCTIONS POUR L'AFFICHAGE DE LA LISTE DES NOTES PAR ELEVE
/******************************************************************/

    public function listNoteAction(Request $request, Application $app)
    {
        $disciplines = $app['dao.discipline']->findAll();

        $examens = $app['dao.examen']->findAll();
        $evaluations = $app['dao.evaluation']->findAll();

        $id_student = $request->request->get('id_student'); //on recupere l'id de l'étudiant

        $student = $app['dao.student']->findStudent($id_student);

        $evaluationStudent = $app['dao.evaluation']->findEvalByStudent($id_student); //on get les notes par étudiant

        return $app['twig']->render('ListTemplate/noteByStudent.html.twig', array(

            'examens'       => $examens,
            'evaluations'   => $evaluations,
            'student'      => $student,
            'disciplines'   => $disciplines,
            'evaluationStudent' => $evaluationStudent,
        ));

    }
 
}

