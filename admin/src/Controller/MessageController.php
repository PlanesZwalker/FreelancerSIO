<?php

namespace freelancerppe\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use freelancerppe\Domain\Message;

class MessageController {

    /**
     * Message page controller.
     */
    public function indexAction(Application $app) {
        $messages = $app['dao.message']->findAll();
        $users = $app['dao.user']->findAll();

        return $app['twig']->render('ListTemplate/messageslist.html.twig', array(
           'role'          =>$users,
           'users'         =>$users,
           'messages'       =>$messages,
        ));
    }
   

    /**
     * Message LIST  controller.
    */
        
    public function listMessageIndexAction(Application $app) {
        $messages = $app['dao.message']->findAll();
        $users = $app['dao.user']->findAll();

       return $app['twig']->render('ListTemplate/messageslist.html.twig', array(
           'role'          =>$users,
           'users'         =>$users,
           'messages'       =>$messages,
       ));

    }
    

    public function listMessageAction(Request $request, Application $app) {
        $messages = $app['dao.message']->findAll();
        $users = $app['dao.user']->findAll();
        $id_user = $request->request->get('id_user'); 
        $role = $request->request->get('role');

        return $app['twig']->render('ListTemplate/messageslist.html.twig', array(
            'role'              =>$role,
            'users'             =>$users,
            'id_user'           => $id_user,
            'messages'       =>$messages,
            
        ));
    }

//                              INDEX DE L AJOUT D UTILISATEURS
    public function addIndexAction(Application $app) {
 
        return $app['twig']->render('FormTemplate/addmessage.html.twig', array(

        ));
    }
    
    
//                              FONCTION D'AJOUT D'UTILISATEUR

    public function addAction(Request $request, Application $app) {

        $salt = substr(md5(time()), 0, 23);

        $newMessage = new Message();
        $users = $app['dao.user']->findAll();
        $messages = $app['dao.message']->findAll();
        $id_user = $request->request->get('id_user'); 
        $role = $request->request->get('role');
        $dt_create = date('Y-m-d H:i:s');
        $dt_update = date('Y-m-d H:i:s');

        if(null !== $request->request->get('id_user'))
        {
            $newMessage->setId_Message($request->request->get('id_user'));
        }

        $newMessage->setPseudo($request->request->get('pseudo'));

        $newMessage->setDate_insc($dt_create);
        $newMessage->setDate_modif($dt_update);

        $app['dao.message']->saveMessage($newMessage);

        $app['session']->getFlashBag()->add('success', 'Message bien enregistré');

       return $app->redirect($app['url_generator']->generate('userslist'));
    }


    /**   *             Edit user controller.            */   

    public function editMessageIndexAction(Request $request, Application $app) {
        
        $id_user = $request->request->get('id_user');
        $messages = $app['dao.message']->findAll();
        $userById = $app['dao.user']->findMessage($id_user);
        
        return $app['twig']->render('FormTemplate/addmessage.html.twig', array(
            'message'          =>$messages,
            'id_user'       =>$id_user,
            'userById'      =>$userById,
         ));
    }

    //MODIFICATION
    public function editMessageAction(Request $request, Application $app)
    {
        $id_user = $request->request->get('id_user');

        $user = $app['dao.user']->findMessage($id_user);
        return $app['twig']->render('FormTemplate/addmessage.html.twig', array(
            'user' => $user,

        ));
    }

    /**  *           Delete user controller.  */
    
    public function deleteMessageIndexAction(Request $request, Application $app) { 
        $id_user = $request->request->get('id_user');
        $newMessage = new Message();
        
        $newMessage->setId_Message($id_user);
       
        $app['dao.user']->deleteMessage($newMessage->getId_Message());

        $app['session']->getFlashBag()->add('danger', 'Utilisateur supprimé !');

        $roles = $app['dao.user']->findAll();
        $users = $app['dao.user']->findAll();


       return $app['twig']->render('ListTemplate/messageslist.html.twig', array(

           'role'          =>$roles,
           'users'         =>$users,
       ));
     
    }
    
// POST ACTION DE SUPPRESSION DE L UTILISATEUR
    
    
    public function deleteMessageAction(Request $request, Application $app) {
        
        $id_user = $request->request->get('id_user');

        $newMessage = new Message();
        
        $newMessage->setIdMessages($id_user);
       
        $app['dao.user']->deleteMessage($id_user);

        $app['session']->getFlashBag()->add('danger', 'Utilisateur supprimé !');

        return $app->redirect($app['url_generator']->generate('messageslist'));

    }


}

