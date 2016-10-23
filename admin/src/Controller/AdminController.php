<?php

namespace freelancerppe\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use freelancerppe\Domain\User;
use freelancerppe\Domain\Freelancer;
use freelancerppe\Domain\Societe;
use freelancerppe\Domain\Test;
use freelancerppe\Domain\Competence;
use freelancerppe\Domain\Projet;

class AdminController extends User{
    /**
     * Admin home page controller.

     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {

     $tests = $app['dao.test']->findAll();
     $tests_total = $app['dao.test']->countAll();
         
     $users = $app['dao.user']->findAll();
     $users_total = $app['dao.user']->countAll(); 

     $projets = $app['dao.projet']->findAll();
     $projets_total = $app['dao.projet']->countAll();
      
     $freelancers = $app['dao.freelancer']->findAll();
     $freelancers_total = $app['dao.freelancer']->countAll();
          
     $competences = $app['dao.competence']->findAll();
     $competences_total = $app['dao.competence']->countAll();
     
     $societes = $app['dao.societe']->findAll();
     $societes_total = $app['dao.societe']->countAll();
     
     $contrats = $app['dao.contrat']->findAll();
     $contrats_total = $app['dao.contrat']->countAll();
     
     $offres = $app['dao.offre']->findAll();
     $offres_total = $app['dao.offre']->countAll();
     $date = date("d/m/Y");
    
    return $app['twig']->render('admintab.html.twig', array(
        
        'users'                 =>$users,
        'users_number'          =>$users_total,
        'competences'           =>$competences,
        'competences_number'    =>$competences_total,
        'tests'                 =>$tests,
        'test_number'           =>$tests_total,
        'projets'               =>$projets,
        'freelancers'           =>$freelancers,
        'freelancers_number'    =>$freelancers_total,
        'projets_number'        =>$projets_total,
        'date'                  =>$date,
        'societes'              =>$societes,
        'societes_number'       =>$societes_total,
        'contrats'              =>$contrats,
        'contrats_number'       =>$contrats_total,
        'offres'                =>$offres,
        'offres_number'         =>$offres_total,
    ));
        

    }
    
 /*   
 public function mdpindexAction(Application $app) {

     $tests = $app['dao.test']->findAll();
     $tests_total = $app['dao.test']->countAll();
         
     $users = $app['dao.user']->findAll();
     $users_total = $app['dao.user']->countAll(); 

     $projets = $app['dao.projet']->findAll();
     $projets_total = $app['dao.projet']->countAll();
      
     $freelancers = $app['dao.freelancer']->findAll();
     $freelancers_total = $app['dao.freelancer']->countAll();
          
     $competences = $app['dao.competence']->findAll();
     $competences_total = $app['dao.competence']->countAll();
     
     $societes = $app['dao.societe']->findAll();
     $societes_total = $app['dao.societe']->countAll();
     
     $date = date("d/m/Y");
    
    return $app['twig']->render('TabTemplate/admintab.html.twig', array(
        
        'users'                 =>$users,
        'users_number'          =>$users_total,
        'competences'           =>$competences,
        'competences_number'    =>$competences_total,
        'tests'                 =>$tests,
        'exam_number'           =>$tests_total,
        'projets'               =>$projets,
        'freelancers'              =>$freelancers,
        'freelancers_number'       =>$freelancers_total,
        'projets_number'        =>$projets_total,
        'date'                  =>$date,
        'societes'              =>$societes,
        'societes_number'       =>$societes_total,
    ));
    

    }
    */
    
    
}

