<?php
/**
 * Created by PhpStorm.
 * User: nfilskov
 * Date: 10/03/2016
 * Time: 14:08
 */

namespace freelancerppe\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use freelancerppe\Domain\Teacher;
use freelancerppe\Domain\User;

class TeacherController
{

//************************************************
//                     INDEX
//**********************************************/

    public function indexAction(Application $app) {
        return $app['twig']->render('TabTemplate/teacherTab.html.twig');
    }
//************************************************
    //                   LISTE
//**********************************************/

    public function listIndexAction(Application $app) {
        $teachers = $app['dao.teacher']->findAll();
        $users = $app['dao.user']->findAll();

        return $app['twig']->render('ListTemplate/teacherlist.html.twig', array(
            'teachers'  => $teachers,
            'users'     => $users,
        ));
    }
    
    //************************************************
//             FONCTIONS D'AJOUT DE FORMATEURS
//**********************************************/

    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     *
     * Affichage de la vue d'ajout d'un professeur
     */
    public function addIndexAction(Application $app) {
        
        $teachers = $app['dao.user']->findAll();
   //     $discipline = $app['dao.discipline']->findAll();

        return $app['twig']->render('FormTemplate/addteacher.html.twig', array(
            'teachers' => $teachers,
    //        'matieres' => $discipline,
        ));
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     *
     * Ajout d'un professeur dans la base de données
     */
    public function addAction(Request $request ,Application $app){

        $salt = substr(md5(time()), 0, 23);

        $newTeacher = new User();

        if(null !== $request->request->get('id_user'))
        {
            $newTeacher->setIdUsers($request->request->get('id_user'));
        }

       // $discipline = $app['dao.discipline']->findDiscipline($request->request->get('id_discipline'));

        $newTeacher->setUsername($request->request->get('username'));
        $newTeacher->setName($request->request->get('name'));
        $newTeacher->setFirstname($request->request->get('firstname'));
        $newTeacher->setPassword($request->request->get('password'));
        $newTeacher->setTel($request->request->get('tel'));
        $newTeacher->setMail($request->request->get('mail'));
        $newTeacher->setRole('ROLE_SOCIETE');
        $newTeacher->setDtCreate(date('Y-m-d H:i:s'));
        $newTeacher->setDtUpdate(date('Y-m-d H:i:s'));
    //    $newTeacher->setDiscipline($discipline);

      //  $disciplines = $app['dao.discipline']->findAll();
        $id_user = $request->request->get('id_user');
        $newTeacher->setSalt($salt);
        $encoder = $app['security.encoder.digest'];
        $newTeacher->setPassword($encoder->encodePassword($request->request->get('password'), $newTeacher->getSalt()));

        $app['dao.user']->saveUser($newTeacher);
      
       if (null !== $id_user) {
            $app['session']->getFlashBag()->add('success', 'La société a bien été modifiée !'); //message flash success si réussi

            return $app->redirect($app['url_generator']->generate('teacherlist'));
        } else {
            $app['session']->getFlashBag()->add('success', 'La société a bien été ajoutée !'); //message flash success si réussi

            return $app->redirect($app['url_generator']->generate('teacherlist'));
        }
    }
    
    

//************************************************
//     FONCTIONS POUR L'EDITION DES FORMATEURS
//**********************************************/
    public function editTeacherIndexAction(Request $request, Application $app)
    {
        $id_teacher = $request->request->get('id_user');
        
        $teacher = $app['dao.teacher']->findTeacher($id_teacher);
  //      $disciplines = $app['dao.discipline']->findAll();

        return $app['twig']->render('FormTemplate/addteacher.html.twig', array(
            'teacher' => $teacher,
    //        'matieres' => $disciplines,
            'id_user' => $id_teacher
        
        ));       
    }
    
    
    /*
 public function myeditTeacher(Request $request, Application $app)
    {
        $id_teacher = $request->request->get('id_user');
 
        $username = $request->request->get('username');
        $name = $request->request->get('name');
        
        $username = $request->request->get('username');
        $firstname = $request->request->get('firstname');
        $tel = $request->request->get('tel');
        $old_discipline = $request->request->get('old_discipline');
        $id_discipline = $request->request->get('id_discipline');
        $mail = $request->request->get('mail');
        $password = $request->request->get('password');
        
        $IdUsers = $request->request->get('id_user');
                
        $teacher = $app['dao.teacher']->findTeacher($id_teacher);
 
         
        $disciplines = $app['dao.discipline']->findAll();
     
        
       $app['dao.teacher']->saveTeacher($teacher, $IdUsers);
      
        return $app['twig']->render('FormTemplate/addteacher.html.twig', array(
            'teacher' => $teacher,
            'matieres' => $disciplines,
            'id_user' => $id_teacher,
            'username' => $username,
               
        ));
       
        
        if (null !== $request->request->get('id_user')) {
            $app['session']->getFlashBag()->add('success', 'Le formateur a bien été modifiée !'); //message flash success si réussi

            return $app->redirect($app['url_generator']->generate('teacherlist'));
        } else {
            $app['session']->getFlashBag()->add('success', 'Le formateur a bien été ajouté !'); //message flash success si réussi

            return $app->redirect($app['url_generator']->generate('teacherlist'));
        }
    }*/

//                      SUPPRESSION
    public function deleteTeacherIndexAction(Request $request, Application $app) {
        $id_teacher = $request->request->get('id');
        $newTeacher = new User();

        $newTeacher->setIdUsers($id_teacher);

        $app['dao.user']->deleteUser($newTeacher->getIdUsers());

        $app['session']->getFlashBag()->add('danger', 'Société supprimée !');

        $teachers = $app['dao.user']->findAll();

        return $app['twig']->render('ListTemplate/teacherlist.html.twig', array(
            'users' => $teachers,
        ));
    }

    public function deleteTeacherAction(Request $request, Application $app)
    {
        $id_teacher = $request->request->get('id');
        $newTeacher = new User();

        $newTeacher->setIdUsers($id_teacher);

        $app['dao.user']->deleteUser($newTeacher->getIdUsers());

        $app['session']->getFlashBag()->add('danger', 'Société supprimée !');

        // On redirige vers le tableau des professeurs

        return $app->redirect($app['url_generator']->generate('teacherlist'));
    }

    
    

//                                STATS
    public function teacherStatIndex(Application $app){
        return $app['twig']->render('StatTemplate/teacherstats.html.twig');
    }

 }