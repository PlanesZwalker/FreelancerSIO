<?php

namespace freelancerppe\Controller;

use freelancerppe\Domain\Student;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use freelancerppe\Domain\ClassName;



class ClassNameController {
   
    
    public function indexAction(Application $app)  {
        
     return $app['twig']->render('TabTemplate/classetab.html.twig');
    }
    
    // INDEX
     public function listIndexAction(Request $request, Application $app)  {

         $classes = $app['dao.className']->findAll();

         $disciplines = $app['dao.discipline']->findAll();
         $users = $app['dao.user']->findAll();

         //on crée un tableau vide qui reçoit chaque nombre d'étudiants par classe
         $StudentByClass = array();

         foreach($classes as $class)
         {
             $id = $class->getIdClassName();//on recupère l'id de la classe courante
             $total = $app['dao.className']->countStudentByClass($id);//on récupère la valeur dans une variable
             $StudentByClass[$id] = $total;//on ajoute dans le tableau...
         }

         return $app['twig']->render('ListTemplate/classeslist.html.twig', array(
             'classes'              => $classes,
             'StudentByClass'       => $StudentByClass,
             'disciplines'          => $disciplines,
             'users'                => $users,
         ));
     }

     // AJOUT INDEX
    public function addIndexAction(Application $app) {

        $classes = $app['dao.className']->findAll();

        return $app['twig']->render('FormTemplate/addclass.html.twig', array(
            'classes' => $classes
        ));
         
    }
    
    // AJOUT TRAITEMENT
    public function addAction(Request $request ,Application $app)
    {

        $newClass = new ClassName();

        if (null !== $request->request->get('id_class')) {
            $newClass->setIdClassName($request->request->get('id_class'));
            $newClass->setDtCreate($newClass->getDtCreate());
        }

        $newClass->setClassName($request->request->get('class_name'));
        $newClass->setClassType($request->request->get('class_type'));
        $newClass->setClassOption($request->request->get('option'));
        $newClass->setClassYear($request->request->get('year'));
        $newClass->setDescription($request->request->get('description'));
        $newClass->setDtCreate('Y-m-d H:i:s');
        $newClass->setDtUpdate(date('Y-m-d H:i:s'));

        $app['dao.className']->saveClassName($newClass);

        if (null !== $request->request->get('id_class')) {
            $app['session']->getFlashBag()->add('success', 'Le projet a été modifié avec succès !');

            return $app->redirect($app['url_generator']->generate('classeslist'));
        }
        else {
            $app['session']->getFlashBag()->add('success', 'Le projet a été ajouté avec succès !');

            return $app->redirect($app['url_generator']->generate('classeslist'));
        }
    }

    public function deleteClassNameIndexAction(Request $request, Application $app)
    {
        $id_class = $request->request->get('id_class');
        $id_students = $request->request->get('id_studentclass');

        $newClass = new ClassName();

        $newClass->setIdClassName($id_class);

        $app['dao.className']->deleteclassName($newClass->getIdClassName());

        $app['session']->getFlashBag()->add('danger', 'Le projet a été supprimé !');

        $classes = $app['dao.className']->findAll();

        return $app['twig']->render('ListTemplate/classeslist.html.twig', array(
            'classe' => $classes,
        ));
    }

    public function deleteClassNameAction(Request $request, Application $app)
    {
        $id_students = $request->request->get('id_studentclass');

        $students = $app['dao.student']->findAllStudentByClass($id_students);

        $newClass = new ClassName();

        $newClass->setIdClassName($id_students);

        $app['dao.className']->deleteclassName($newClass->getIdClassName());

        $app['session']->getFlashBag()->add('danger', 'Le projet a été supprimé !');

        // Redirecton vers le tableau des classes

        return $app->redirect($app['url_generator']->generate('classeslist'));
    }

    //MODIFICATION
    public function editClassNameAction(Request $request, Application $app)
    {
        $id_class = $request->request->get('id_class');

        $classname = $app['dao.className']->findClassName($id_class);

        return $app['twig']->render('FormTemplate/addclass.html.twig', array(
            'classname' => $classname,
        ));
    }

    //Affichage de la liste des étudiants par classe
    public function listStudentIndexAction(Request $request, Application $app)
    {
        $classes = $app['dao.className']->findAll();

        $id_class = $request->request->get('id_studentclass');

        $classe = $app['dao.className']->findClassname($id_class);

        $students = $app['dao.student']->findAllStudentByClass($id_class); //tous les étudiants de la classe en param

        return $app['twig']->render('ListTemplate/studentByClass.html.twig', array(
            'allStudents'   => $students,
            'classe'        => $classe,
            'classes'       => $classes,
        ));
    }

    //Action sur la modification des élèves de classe
    public function updateStudentAction(Request $request, Application $app)
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
}

