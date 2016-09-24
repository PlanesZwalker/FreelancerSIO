<?php

namespace freelancerppe\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use freelancerppe\Domain\Student;
use freelancerppe\Domain\User;

/**
 * Description of StudentController
 *
 * @author ajj
 */
class StudentController
{

//************************************************
//                     INDEX
//**********************************************/

    public function indexAction(Application $app)
    {

        return $app['twig']->render('TabTemplate/studenttab.html.twig');
    }

//************************************************
    //                   LISTE
//**********************************************/

    public function listIndexAction(Request $request, Application $app)
    {

        $etudiants = $app['dao.student']->findAll();

        return $app['twig']->render('ListTemplate/studentslist.html.twig', array(
            'students' => $etudiants,
        ));
    }

//************************************************
//             FONCTIONS D'AJOUT D'ETUDIANT
//**********************************************/

    public function addIndexAction(Request $request, Application $app)
    {

        $classes = $app['dao.className']->findAll();
        $statuts = $app['dao.statutStudent']->findAll();

        return $app['twig']->render('FormTemplate/addstudent.html.twig', array(
            'classes' => $classes,
            'statuts' => $statuts,
        ));
    }


    public function addAction(Request $request, Application $app)
    {

        $newStudent = new Student();

        $class = $app['dao.className']->findClassname($request->request->get('classname'));
        $statuts = $app['dao.statutStudent']->findStatut($request->request->get('statut'));

        if (null !== $request->request->get('id_student')) {
            $newStudent->setIdStudent($request->request->get('id_student'));
        }

        $newStudent->setName($request->request->get('name'));
        $newStudent->setFirstname($request->request->get('firstname'));
        $newStudent->setBirthday($request->request->get('birthday'));
        $newStudent->setAddress($request->request->get('address'));
        $newStudent->setTel($request->request->get('phone'));
        $newStudent->setEmail($request->request->get('email'));
        $newStudent->setDtCreate(date('Y-m-d H:i:s'));
        $newStudent->setDtUpdate(date('Y-m-d H:i:s'));
        $newStudent->setClass($class);
        $newStudent->setStatut($statuts);

        $app['dao.student']->saveStudent($newStudent);

        $classes = $app['dao.className']->findAll();

        if (null !== $request->request->get('id_student')) {
            $app['session']->getFlashBag()->add('success', 'L\'étudiant a bien été modifié !'); //message flash success si réussi

            return $app->redirect($app['url_generator']->generate('studentslist'));
        } else {
            $app['session']->getFlashBag()->add('success', 'L\'étudiant a bien été ajouté !'); //message flash success si réussi

            return $app->redirect($app['url_generator']->generate('studentslist'));
        }
    }

//************************************************
//     FONCTIONS POUR L'EDITION DES ETUDIANTS
//**********************************************/

    public function editStudentIndexAction(Request $request, Application $app)
    {
        $id_student = $request->request->get('id_student');

        $student = $app['dao.student']->findStudent($id_student);
        $classes = $app['dao.className']->findAll();
        $statuts = $app['dao.statutStudent']->findAll();

        return $app['twig']->render('FormTemplate/addstudent.html.twig', array(
            'student' => $student,
            'classes' => $classes,
            'statuts' => $statuts,

        ));
    }

//************************************************
//             FONCTIONS DE SUPPRESSION
//**********************************************/

    public function deleteStudentIndexAction(Request $request, Application $app)
    {
        $students = $app['dao.student']->findAll();

        $app['session']->getFlashBag()->add('danger', 'Étudiant supprimé !');

        return $app['twig']->render('ListTemplate/studentslist.html.twig', array(
            'students' => $students,
        ));
    }

    public function deleteStudentAction(Request $request, Application $app)
    {
        $id_student = $request->request->get('id_student');
        $newStudent = new Student();
        $newStudent->setIdStudent($id_student);

        $app['dao.student']->deleteStudent($newStudent->getIdStudent());

        return $this::deleteStudentIndexAction($request, $app);

    }

//************************************************
//      FONCTIONS POUR LES  STATISTIQUES
//**********************************************/
    public function studentStatIndex(Request $request, Application $app)
    {
        $id_student = $request->request->get('id_student');

        $etudiants = $app['dao.student']->findAll();;

        return $app['twig']->render('StatTemplate/studentstats.html.twig', array(
            'students'      => $etudiants,

        ));
    }

    public function statByStudentIndexAction(Request $request, Application $app)
    {
        $id_student = $request->request->get('id_student');

        $id_class = $request->request->get('id_class');

        $etudiants = $app['dao.student']->findAll();
        $evaluation = $app['dao.evaluation']->findAll();
        $discipline = $app['dao.discipline']->findAll();
        
        $examen = $app['dao.examen']->findAllExamenByClass($id_class);

        $student = $app['dao.student']->findStudent($id_student);

        $evaluationByStudent = $app['dao.evaluation']->findEvalByStudent($id_student);

        return $app['twig']->render('StatTemplate/statByStudent.html.twig', array(
            'student'       => $student,
            'evaluationByStudent' => $evaluationByStudent,
            'examenAll' => $examen,
            'matiere' => $discipline

        ));
    }


}
