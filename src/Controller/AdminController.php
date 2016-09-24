<?php

namespace freelancerppe\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use freelancerppe\Domain\User;
use freelancerppe\Domain\StudentToClass;
use freelancerppe\Domain\Student;
use freelancerppe\Domain\DisciplineToClass;
use freelancerppe\Domain\Evaluation;
use freelancerppe\Domain\Discipline;
use freelancerppe\Domain\ClassName;

use freelancerppe\Form\Type\addNoteForm;



class AdminController {


    /**

     * Admin home page controller.

     *

     * @param Application $app Silex application

     */

    public function indexAction(Application $app) {

     $exams = $app['dao.examen']->findAll();
     $exams_total = $app['dao.examen']->countAll();
         
     $users = $app['dao.user']->findAll();
     $users_total = $app['dao.user']->countAll(); 

     $classes = $app['dao.className']->findAll();
     $classes_total = $app['dao.className']->countAll();
      
     $students = $app['dao.student']->findAll();
     $students_total = $app['dao.student']->countAll();
          
     $disciplines = $app['dao.discipline']->findAll();
     $disciplines_total = $app['dao.discipline']->countAll();
     
     $date = date("d/m/Y");
    
    return $app['twig']->render('TabTemplate/admintab.html.twig', array(
        
        'users'                 =>$users,
        'users_number'          =>$users_total,
        'disciplines'           =>$disciplines,
        'disciplines_number'    =>$disciplines_total,
        'exams'                 =>$exams,
        'exam_number'           =>$exams_total,
        'classes'               =>$classes,
        'students'              =>$students,
        'students_number'       =>$students_total,
        'classes_number'        =>$classes_total,
        'date'                  =>$date,
    ));
    

    }
    
    
 public function mdpindexAction(Application $app) {

     $exams = $app['dao.examen']->findAll();
     $exams_total = $app['dao.examen']->countAll();
         
     $users = $app['dao.user']->findAll();
     $users_total = $app['dao.user']->countAll(); 

     $classes = $app['dao.className']->findAll();
     $classes_total = $app['dao.className']->countAll();
      
     $students = $app['dao.student']->findAll();
     $students_total = $app['dao.student']->countAll();
          
     $disciplines = $app['dao.discipline']->findAll();
     $disciplines_total = $app['dao.discipline']->countAll();
     
     $date = date("d/m/Y");
    
    return $app['twig']->render('TabTemplate/admintab.html.twig', array(
        
        'users'                 =>$users,
        'users_number'          =>$users_total,
        'disciplines'           =>$disciplines,
        'disciplines_number'    =>$disciplines_total,
        'exams'                 =>$exams,
        'exam_number'           =>$exams_total,
        'classes'               =>$classes,
        'students'              =>$students,
        'students_number'       =>$students_total,
        'classes_number'        =>$classes_total,
        'date'                  =>$date,
    ));
    

    }


}

