<?php

namespace freelancerppe\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use freelancerppe\Domain\Societe;
use freelancerppe\Domain\User;

class SocieteController
{

//************************************************
//                     INDEX
//**********************************************/

    public function indexAction(Application $app) {
        return $app['twig']->render('TabTemplate/societeTab.html.twig');
    }
//************************************************
    //                   LISTE
//**********************************************/

    public function listIndexAction(Application $app) {
        $societes = $app['dao.societe']->findAll();
        $societes = $app['dao.societe']->findAll();

        return $app['twig']->render('ListTemplate/societeslist.html.twig', array(
            'societes'  => $societes,
            'societes'     => $societes,
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
     * Affichage de la vue d'ajout d'une societe
     */
    public function addIndexAction(Application $app) {
        
        $societes = $app['dao.societe']->findAll();

        return $app['twig']->render('FormTemplate/addsociete.html.twig', array(
            'societes' => $societes,
        ));
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     *
     * Ajout d'une societe dans la base de données
     */
    public function addAction(Request $request ,Application $app){

        $salt = substr(md5(time()), 0, 23);

        $newSociete = new User();

        if(null !== $request->request->get('id_societe'))
        {
            $newSociete->setIdUser($request->request->get('id_societe'));
        }

        $newSociete->setPseudo($request->request->get('pseudo'));
        $newSociete->setNomsociete($request->request->get('nomsociete'));
        $newSociete->setPrenomsociete($request->request->get('prenomsociete'));
        $newSociete->setMotdepasse($request->request->get('motdepasse'));
        $newSociete->setTelephone($request->request->get('telephone'));
        $newSociete->setEmail($request->request->get('email'));
        $newSociete->setRole('ROLE_SOCIETE');
        $newSociete->setDate_insc(date('Y-m-d H:i:s'));
        $newSociete->setDate_modif(date('Y-m-d H:i:s'));

        $id_societe = $request->request->get('id_societe');
        $newSociete->setSalt($salt);
        $encoder = $app['security.encoder.digest'];
        $newSociete->setMotdepasse($encoder->encodePassword($request->request->get('password'), $newSociete->getSalt()));

        $app['dao.societe']->saveUser($newSociete);
      
       if (null !== $id_societe) {
            $app['session']->getFlashBag()->add('success', 'La société a bien été modifiée !'); //message flash success si réussi

            return $app->redirect($app['url_generator']->generate('societeslist'));
        } else {
            $app['session']->getFlashBag()->add('success', 'La société a bien été ajoutée !'); //message flash success si réussi

            return $app->redirect($app['url_generator']->generate('societeslist'));
        }
    }
    
    

//************************************************
//     FONCTIONS POUR L'EDITION DES SOCIETES
//**********************************************/
    public function editSocieteIndexAction(Request $request, Application $app)
    {
        $id_societe = $request->request->get('id_societe');
        
        $societe = $app['dao.societe']->findSociete($id_societe);
        
        return $app['twig']->render('FormTemplate/addsociete.html.twig', array(
            'societe' => $societe,
            'id_societe' => $id_societe
        ));       
    }
    
    
   
 public function myeditSociete(Request $request, Application $app)
    {
        $id_societe = $request->request->get('id_societe');
 
        $pseudo = $request->request->get('pseudo');
        $name = $request->request->get('name');
        
        $societename = $request->request->get('nomuser');
        $firstname = $request->request->get('prenomuser');
        $tel = $request->request->get('telehone');
        $mail = $request->request->get('email');
        $password = $request->request->get('motdepasse');
        
        $IdUsers = $request->request->get('id_societe');
                
        $societe = $app['dao.societe']->findSociete($id_societe);
        
       $app['dao.societe']->saveSociete($societe, $IdUsers);
      
        return $app['twig']->render('FormTemplate/addsociete.html.twig', array(
            'societe' => $societe,
            'id_societe' => $id_societe,
            'pseudo' => $pseudo,
               
        ));
       
        
        if (null !== $request->request->get('id_societe')) {
            $app['session']->getFlashBag()->add('success', 'Le formateur a bien été modifiée !'); //message flash success si réussi

            return $app->redirect($app['url_generator']->generate('societeslist'));
        } else {
            $app['session']->getFlashBag()->add('success', 'Le formateur a bien été ajouté !'); //message flash success si réussi

            return $app->redirect($app['url_generator']->generate('societeslist'));
        }
    }

//                      SUPPRESSION
    public function deleteSocieteIndexAction(Request $request, Application $app) {
        $id_societe = $request->request->get('id');
        $newSociete = new User();

        $newSociete->setIdUsers($id_societe);

        $app['dao.societe']->deleteUser($newSociete->getIdUsers());

        $app['session']->getFlashBag()->add('danger', 'Société supprimée !');

        $societes = $app['dao.societe']->findAll();

        return $app['twig']->render('ListTemplate/societeslist.html.twig', array(
            'societes' => $societes,
        ));
    }

    public function deleteSocieteAction(Request $request, Application $app)
    {
        $id_societe = $request->request->get('id');
        $newSociete = new User();

        $newSociete->setIdUsers($id_societe);

        $app['dao.societe']->deleteUser($newSociete->getIdUsers());

        $app['session']->getFlashBag()->add('danger', 'Société supprimée !');

        // On redirige vers la liste des sociétés
        return $app->redirect($app['url_generator']->generate('societeslist'));
    }

//                                STATS
    public function societeStatIndex(Application $app){
        return $app['twig']->render('StatTemplate/societestats.html.twig');
    }

 }