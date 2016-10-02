<?php

namespace freelancerppe\Controller;

use freelancerppe\Domain\Discipline;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

use freelancerppe\Domain\User;



class UserController {

    /**
     * User page controller.
     */
    public function indexAction(Request $request, Application $app) {
              
        $classes = $app['dao.className']->findAll();
        //$disciplines = $app['dao.discipline']->findAll();
        $roles = $app['dao.user']->findAll();
        $users = $app['dao.user']->findAll();

       return $app['twig']->render('ListTemplate/userslist.html.twig', array(
           'classe'        =>$classes,
    //       'discipline'    =>$disciplines,
           'role'          =>$roles,
           'users'         =>$users,
       ));
    }
    
    //               TABLEAU DE BORD USER
     public function tabUserAction(Application $app) {
              
        $classes = $app['dao.className']->findAll();
    //    $disciplines = $app['dao.discipline']->findAll();
        $roles = $app['dao.user']->findAll();
        $users = $app['dao.user']->findAll();

       return $app['twig']->render('TabTemplate/usertab.html.twig', array(
           'classe'        =>$classes,
     //      'discipline'    =>$disciplines,
           'role'          =>$roles,
           'users'         =>$users,
       ));
    }

    /**
     * User LIST  controller.
    */
        
    public function listUserIndexAction(Application $app) {
                   
        $classes = $app['dao.className']->findAll();
    //    $disciplines = $app['dao.discipline']->findAll();
        $roles = $app['dao.user']->findAll();
        $users = $app['dao.user']->findAll();


       return $app['twig']->render('ListTemplate/userslist.html.twig', array(
           'classe'        =>$classes,
      //     'discipline'    =>$disciplines,
           'role'          =>$roles,
           'users'         =>$users,
       ));

    }
    

    public function listUserAction(Request $request, Application $app) {
               
        $classes = $app['dao.className']->findAll();
     //   $disciplines = $app['dao.discipline']->findAll();
        $users = $app['dao.user']->findAll();
        
        $id_user = $request->request->get('id_user'); 
        $id_class = $request->request->get('id_class');
  //      $id_discipline = $request->request->get('id_discipline');
        $role = $request->request->get('role');

        return $app['twig']->render('ListTemplate/userslist.html.twig', array(
            
            'classes'           =>$classes,
            'disciplines'       =>$disciplines,
            'role'              =>$role,
            'users'             =>$users,
            'id_class'          => $id_class,
     //       'id_discipline'     => $id_discipline,
            'id_user'           => $id_user,
            
        ));
    }

//                              INDEX DE L AJOUT D UTILISATEURS
    public function addIndexAction(Application $app) {
    
        $classes = $app['dao.className']->findAll();
     //   $discipline = $app['dao.discipline']->findAll();
        
        return $app['twig']->render('FormTemplate/adduser.html.twig', array(
            'classe'            =>  $classes,
     //       'matieres'          => $discipline,

        ));
    }
    
    
//                              FONCTION D'AJOUT D'UTILISATEUR

    public function addAction(Request $request, Application $app) {

        $salt = substr(md5(time()), 0, 23);

        $newUser = new User();
     //   $disciplines = $app['dao.discipline']->findAll();
        $users = $app['dao.user']->findAll();

        $dt_create = date('Y-m-d H:i:s');
        $dt_update = date('Y-m-d H:i:s');

     //   $id_discipline = $request->request->get('id_discipline');

        if(null !== $request->request->get('id_user'))
        {
            $newUser->setIdUsers($request->request->get('id_user'));
        }

        $newUser->setUsername($request->request->get('username'));
        $newUser->setName($request->request->get('name'));
        $newUser->setFirstName($request->request->get('firstname'));
        $newUser->setDescription($request->request->get('description'));
        $newUser->setRole($request->request->get('role'));
      /*  if($id_discipline == 0)
            $newUser->setDiscipline(new Discipline(0));
        else{
            $discipline = $app['dao.discipline']->findDiscipline($id_discipline);
            $newUser->setDiscipline($discipline);
        }*/

        $newUser->setSalt($salt);
        $encoder = $app['security.encoder.digest'];
        $newUser->setPassword($encoder->encodePassword($request->request->get('password'), $newUser->getSalt()));

        $newUser->setMail($request->request->get('mail'));
        $newUser->setTel($request->request->get('phone'));

        $newUser->setDtCreate($dt_create);
        $newUser->setDtUpdate($dt_update);
        
              
        $classes = $app['dao.className']->findAll();
     //   $disciplines = $app['dao.discipline']->findAll();
        $users = $app['dao.user']->findAll();
        
        $id_user = $request->request->get('id_user'); 
        $id_class = $request->request->get('id_class');
  //      $id_discipline = $request->request->get('id_discipline');
        $role = $request->request->get('role');
        

        $app['dao.user']->saveUser($newUser);

        $app['session']->getFlashBag()->add('success', 'Utilisateur bien enregistré');

        return $app['twig']->render('ListTemplate/userslist.html.twig', array(
            
            'classes'           =>$classes,
       //     'disciplines'       =>$disciplines,
            'role'              =>$role,
            'users'             =>$users,
            'id_class'          => $id_class,
     //       'id_discipline'     => $id_discipline,
            'id_user'           => $id_user,
            
           /* 'matieres' => $disciplines*/));
    }


    /**   *             Edit user controller.            */   

    public function editUserIndexAction(Request $request, Application $app) {
        
        $id_user = $request->request->get('id_user');
               
        $classes = $app['dao.className']->findAll();
     //   $disciplines = $app['dao.discipline']->findAll();
        $users = $app['dao.user']->findAll();

        $userById = $app['dao.user']->findUser($id_user);
        
        return $app['twig']->render('FormTemplate/adduser.html.twig', array(
            'classe'        =>$classes,
       //     'discipline'    =>$disciplines,
            'user'          =>$users,
            'id_user'       =>$id_user,
            'userById'      =>$userById,

         ));
    }

    //MODIFICATION
    public function editUserAction(Request $request, Application $app)
    {
        $id_user = $request->request->get('id_user');

        $user = $app['dao.user']->findUser($id_user);
        $discipline = $app['dao.discipline']->findAll();

        return $app['twig']->render('FormTemplate/adduser.html.twig', array(
            'user' => $user,
            'matieres' => $discipline
        ));
    }

    /**  *           Delete user controller.  */
    
    public function deleteUserIndexAction(Request $request, Application $app) { 
        $id_user = $request->request->get('id_user');
        $newUser = new User();
        
        $newUser->setIdUsers($id_user);
       
        $app['dao.user']->deleteUser($newUser->getIdUsers());

        $app['session']->getFlashBag()->add('danger', 'Utilisateur supprimé !');
            
        $classes = $app['dao.className']->findAll();
      //  $disciplines = $app['dao.discipline']->findAll();
        $roles = $app['dao.user']->findAll();
        $users = $app['dao.user']->findAll();


       return $app['twig']->render('ListTemplate/userslist.html.twig', array(
           'classe'        =>$classes,
         //  'discipline'    =>$disciplines,
           'role'          =>$roles,
           'users'         =>$users,
       ));
     
    }
    
// POST ACTION DE SUPPRESSION DE L UTILISATEUR
    
    
    public function deleteUserAction(Request $request, Application $app) {
        
        $id_user = $request->request->get('id_user');

        $newUser = new User();
        
        $newUser->setIdUsers($id_user);
       
        $app['dao.user']->deleteUser($id_user);

        $app['session']->getFlashBag()->add('danger', 'Utilisateur supprimé !');

        return $app->redirect($app['url_generator']->generate('userslist'));

    }

    // Page de tout les ajout regrouper
    public function addPersonAction(Application $app)
    {
        $classes = $app['dao.className']->findAll();
    //    $statuts  = $app['dao.statutStudent']->findAll();

        return $app['twig']->render('AddPerson.html.twig', array(
            'classes' => $classes,
      /*      'statuts' => $statuts,*/));
    }

    // Page de toute les listes regrouper
    public function listGroupAction(Application $app)
    {
        return $app['twig']->render('listGrouper.html.twig');
    }


}

