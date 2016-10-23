<?php

namespace freelancerppe\Controller;

use Silex\Application;
use Silex\Controller;
use Symfony\Component\HttpFoundation\Request;
use freelancerppe\Domain;

class HomeController
{
    /**
     * Home page controller.
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {
        
        $projets = $app['dao.projet']->findAll();
        $tests = $app['dao.test']->findAll();
       // $url = explode('/',$_SERVER['REQUEST_URI']);
   
        $projets_total = $app['dao.projet']->countAll();

        $freelancers = $app['dao.freelancer']->findAll();
        $freelancers_total = $app['dao.freelancer']->countAll();
        $date = date('d/m/Y');

        return $app['twig']->render('index.html.twig', array(
         
            'projets'               =>$projets,
            'tests'                 =>$tests,
            'projets_number'        =>$projets_total,
            'freelancers'              =>$freelancers,
            'freelancers_number'       =>$freelancers_total,
            'date'                  =>$date,
    //        'url'                   =>$url[1],
        ));
    }

    /**
     * User login controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function loginAction(Request $request, Application $app) {

           
        return $app['twig']->render('login.html.twig', array(
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
            ));
    }
    
    public function login_checkAction(Request $request, Application $app) {
              
        return $app['twig']->render('index.html.twig', array(
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
            ));
    }
      
}
