<?php
/**
 * Created by PhpStorm.
 * User: Val
 * Date: 05/02/2016
 * Time: 09:09
 */
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Silex\Application;

use Silex\Application\UrlGeneratorServiceProvider;

use Silex\Provider\FormServiceProvider;
use freelancerppe\DAO;
use freelancerppe\DAO\DisciplineDAO;
use freelancerppe\Domain;


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
            }),  //    $user->setDisciplineDAO(new freelancerppe\DAO\DisciplineDAO($app['db']));
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


//                                                        CONTROLLERS
/**
 * controller pour la route des matières
 */
$app['dao.discipline'] = $app->share(function($app){
    return new DisciplineDAO($app['db']);
}); 
/**
 * Controller pour la route des classes
 *
 */
$app['dao.className'] = $app->share(function($app){
    return new freelancerppe\DAO\ClassNameDAO($app['db']);
});
/**
 * Controller pour la route des étudiants
 *
 */
$app['dao.student'] = $app->share(function($app){
    $studentDAO = new freelancerppe\DAO\StudentDAO($app['db']);
    $studentDAO->setClassDAO($app['dao.className']);
   // $studentDAO->setStatutStudentDAO($app['dao.statutStudent']);
    return $studentDAO;
});
/**
 * Controller pour la route des examens
 */
$app['dao.examen'] = $app->share(function($app){
    $examenDAO = new freelancerppe\DAO\ExamenDAO($app['db']);
    $examenDAO->setClassDAO($app['dao.className']);
 //   $examenDAO->setDisciplineDAO($app['dao.discipline']);
    return $examenDAO;
});

/**
 * Controller pour la route des notes
 */
$app['dao.evaluation'] = $app->share(function($app){
    $evaluationDAO = new freelancerppe\DAO\EvaluationDAO($app['db']);
    $evaluationDAO->setStudentDAO($app['dao.student']);
    $evaluationDAO->setExamenDAO($app['dao.examen']);


    return $evaluationDAO;
});


/**
 * Controller pour la route des utilisateurs
 *
 */
$app['dao.user'] = $app->share(function($app){
    $userDAO = new freelancerppe\DAO\UserDAO($app['db']);
   // $userDAO->setDisciplineDAO(new freelancerppe\DAO\DisciplineDAO($app['db']));

    return $userDAO;
});

/**
 * Controller pour la route des professeurs
 */
$app['dao.teacher'] = $app->share(function($app){
    $teacherDAO = new freelancerppe\DAO\TeacherDAO($app['db']);
 /*   $teacherDAO->setDisciplineDAO($app['dao.discipline']); */

    return $teacherDAO;
});

/**
 * Controller pour la route des statuts étudiants
 
$app['dao.statutStudent'] = $app->share(function($app){
    return new freelancerppe\DAO\StatutStudentDAO($app['db']);
});
*/
$app['dao.event'] = $app->share(function($app){
    return new freelancerppe\DAO\EventDAO($app['db']);
});


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


return $app;

