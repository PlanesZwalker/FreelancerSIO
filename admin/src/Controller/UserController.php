<?php

namespace freelancerppe\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

//use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

use freelancerppe\Domain\User;


class UserController {

    /**
     * User page controller.
     */
    public function indexAction(Application $app) {

        $users = $app['dao.user']->findAll();

        return $app['twig']->render('ListTemplate/userslist.html.twig', array(
           'role'          =>$users,
           'users'         =>$users,
        ));
    }
    
    //               TABLEAU DE BORD USER
     public function tabUserAction(Application $app) {
              
    //    $classes = $app['dao.Projet']->findAll();
        $roles = $app['dao.user']->findAll();
        $users = $app['dao.user']->findAll();

       return $app['twig']->render('TabTemplate/usertab.html.twig', array(
    //       'classe'        =>$classes,
     //      'competence'    =>$competences,
           'role'          =>$roles,
           'users'         =>$users,
       ));
    }

    /**
     * User LIST  controller.
    */
        
    public function listUserIndexAction(Application $app) {
                   
  //      $classes = $app['dao.Projet']->findAll();
        $roles = $app['dao.user']->findAll();
        $users = $app['dao.user']->findAll();


       return $app['twig']->render('ListTemplate/userslist.html.twig', array(
    //       'classe'        =>$classes,
           'role'          =>$roles,
           'users'         =>$users,
       ));

    }
    

    public function listUserAction(Request $request, Application $app) {
               
  //      $classes = $app['dao.Projet']->findAll();
        $users = $app['dao.user']->findAll();
        
        $id_user = $request->request->get('id_user'); 
    //    $id_class = $request->request->get('id_class');
        $role = $request->request->get('role');

        return $app['twig']->render('ListTemplate/userslist.html.twig', array(
            
     //       'classes'           =>$classes,
       //     'competences'       =>$competences,
            'role'              =>$role,
            'users'             =>$users,
       //     'id_class'          => $id_class,
            'id_user'           => $id_user,
            
        ));
    }

//                              INDEX DE L AJOUT D UTILISATEURS
    public function addIndexAction(Application $app) {
    
      //  $classes = $app['dao.Projet']->findAll();
        
        return $app['twig']->render('FormTemplate/adduser.html.twig', array(
    //        'classe'            =>  $classes,
        ));
    }
    
    
//                              FONCTION D'AJOUT D'UTILISATEUR

    public function addAction(Request $request, Application $app) {

        $salt = substr(md5(time()), 0, 23);

        $newUser = new User();
        $users = $app['dao.user']->findAll();
        $id_user = $request->request->get('id_user'); 
        $role = $request->request->get('role');
        $dt_create = date('Y-m-d H:i:s');
        $dt_update = date('Y-m-d H:i:s');

        if(null !== $request->request->get('id_user'))
        {
            $newUser->setId_User($request->request->get('id_user'));
        }

        $newUser->setPseudo($request->request->get('pseudo'));
        $newUser->setNomuser($request->request->get('nomuser'));
        $newUser->setPrenomuser($request->request->get('prenomuser'));
        $newUser->setRole($request->request->get('role'));
        $newUser->setSalt($salt);
        $encoder = $app['security.encoder.digest'];
        $newUser->setMotdepasse($encoder->encodePassword($request->request->get('motdepasse'), $newUser->getSalt()));
        $newUser->setEmail($request->request->get('email'));
        $newUser->setTelephone($request->request->get('telephone'));
        $newUser->setDate_insc($dt_create);
        $newUser->setDate_modif($dt_update);

        $app['dao.user']->saveUser($newUser);

        $app['session']->getFlashBag()->add('success', 'Utilisateur bien enregistré');

       return $app->redirect($app['url_generator']->generate('userslist'));
    }


    /**   *             Edit user controller.            */   

    public function editUserIndexAction(Request $request, Application $app) {
        
        $id_user = $request->request->get('id_user');
        $users = $app['dao.user']->findAll();
        $userById = $app['dao.user']->findUser($id_user);
        
        return $app['twig']->render('FormTemplate/adduser.html.twig', array(
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
        

        return $app['twig']->render('FormTemplate/adduser.html.twig', array(
            'user' => $user,

        ));
    }

    /**  *           Delete user controller.  */
    
    public function deleteUserIndexAction(Request $request, Application $app) { 
        $id_user = $request->request->get('id_user');
        $newUser = new User();
        
        $newUser->setId_User($id_user);
       
        $app['dao.user']->deleteUser($newUser->getId_User());

        $app['session']->getFlashBag()->add('danger', 'Utilisateur supprimé !');

        $roles = $app['dao.user']->findAll();
        $users = $app['dao.user']->findAll();


       return $app['twig']->render('ListTemplate/userslist.html.twig', array(

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
        $classes = $app['dao.Projet']->findAll();
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

