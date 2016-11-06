<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Silex\Application;
use Silex\Application\UrlGeneratorServiceProvider;
use Silex\Provider\FormServiceProvider;
use freelancerppe\DAO;



// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Moteur de Templates
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
    'twig.class_path' => __DIR__.'/../vendor/twig/twig/lib',
));

// ORM 
$app->register(new Silex\Provider\DoctrineServiceProvider());

// Provider pour la gestion de sessions
$app->register(new Silex\Provider\SessionServiceProvider());


/** Service pour l'authentification **/
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'login' => array(
            'pattern' => '^/login$',
        ),
        'secured' => array(
            'pattern' => '^.*$',
            'anonymous' => false,
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => $app->share(function () use($app){
                $user = new freelancerppe\DAO\UserDAO($app['db']);

                return $user;
            }),  
        ),
    ),
));

$app->register(new Silex\Provider\ValidatorServiceProvider());


/** ************************************** **/

/**
 * Provider pour la génération des urls
 *
 */
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());



/**
 * Hiérarchie des utilisateurs
 *
 * 
 */
$app['security.role_hierarchy'] = array(
    'ROLE_FREELANCER'=> array('ROLE_SOCIETE'),
    'ROLE_ADMIN'    => array('ROLE_FREELANCER'),
   
);

/**
 * Les rôles des utilisateurs
*/
$app['security.access_rules'] = array(
    array('^/admin/.*$', 'ROLE_ADMIN'),
    array('^/teacher/.*$\'', 'ROLE_FREELANCER'),
    array('^.*$','ROLE_SOCIETE'),
  
);


/**
 * Controlleurs gérer les utilisateurs
 *
 */
$app['dao.user'] = $app->share(function($app){
    $userDAO = new freelancerppe\DAO\UserDAO($app['db']);
    return $userDAO;
});
$app['dao.fos_user'] = $app->share(function($app){
    $userDAO = new freelancerppe\DAO\FosUserDAO($app['db']);
    return $userDAO;
});



/**
 * Controlleurs pour gérer les sociétés
 */
$app['dao.societe'] = $app->share(function($app){
    $societeDAO = new freelancerppe\DAO\SocieteDAO($app['db']);
    return $societeDAO;
});

/**
 * Controller pour la route des freelancers
 */
$app['dao.freelancer'] = $app->share(function($app){
    $freelancerDAO = new freelancerppe\DAO\FreelancerDAO($app['db']);
    return $freelancerDAO;
});

/**
 * Controller pour la route des projets
 */
$app['dao.projet'] = $app->share(function($app){
    $projetDAO =  new freelancerppe\DAO\ProjetDAO($app['db']);
    return $projetDAO;
});

/**
 * Controller pour la route des compteences
 */
$app['dao.competence'] = $app->share(function($app){
    $competenceDAO = new freelancerppe\DAO\CompetenceDAO($app['db']);
    return $competenceDAO;
});

/**
 * Controller pour la route des tests
 */
$app['dao.test'] = $app->share(function($app){
    $testDAO = new freelancerppe\DAO\TestDAO($app['db']);
    return $testDAO;
});

/**
 * Controller pour la route les messages
 */
$app['dao.message'] = $app->share(function($app){
    $messageDAO = new freelancerppe\DAO\MessageDAO($app['db']);
    return $messageDAO;
});


/**
 * controller pour la route des competences
*/
$app['dao.competence'] = $app->share(function($app){
    $competenceDAO = new freelancerppe\DAO\CompetenceDAO($app['db']);
    return  $competenceDAO ;
}); 

/**
 * controller pour la route des contrats
*/
$app['dao.contrat'] = $app->share(function($app){
    $contratDAO = new freelancerppe\DAO\ContratDAO($app['db']);
    return $contratDAO;
}); 

/**
 * controller pour la route des offres
*/
$app['dao.offre'] = $app->share(function($app){
    $offreDAO = new freelancerppe\DAO\OffreDAO($app['db']);
    return $offreDAO;
}); 




return $app;
