<?php
/**                                                           Home controller
/*                                                           AdminController
*              TABLEAU DE BORD ADMIN
*                                               route pour l'affichage de la liste des etudiants
*/


$app->get('/admin/admintab', "freelancerppe\Controller\AdminController::indexAction")->bind('admintab');

/*
 *
 *
 *                 ACCUEIL
 *
 *                                                           AFFICHAGE ACCUEIL
 */

$app->get('/', "freelancerppe\Controller\HomeController::indexAction");

$app->get('/accueil', "freelancerppe\Controller\HomeController::indexAction")->bind('accueil');
/**
 *
 *               CALENDRIER
 *
 *                                                     route pour afficher le calendrier
 */
$app->get('/calendar',"freelancerppe\Controller\CalendarController::indexAction")->bind('calendar');
/**
 *
 *                 LOGIN
 *
 *                                                      route pour afficher le login
 */
$app->get('/login', "freelancerppe\Controller\HomeController::loginAction")->bind('login');
/*$app->get('/login_check', "freelancerppe\Controller\HomeController::login_checkAction")->bind('login_check');*/


/* mot de passe */
$app->match('/mdp', "freelancerppe\Controller\AdminController::mdpIndexAction")->bind('mdp');


/* Redirection vers le site freelancer */
$app->match('../../../web/front')->bind('front');



/**
 *
 *
 *                  PAGE DES AJOUTS ET LISTES
 *
 *                                                      route pour afficher les pages de formulaires
 */
$app->get('/formulaire', "freelancerppe\Controller\UserController::addPersonAction")->bind('addPerson');
$app->get('/Liste',"freelancerppe\Controller\UserController::listGroupAction")->bind('listGroup');




/**
 *
 *
 *            UTILISATEURS
 *
 *                                             TABLEAU DE BORD DE GESTION DES UTILISATEURS
 */
$app->get('/usertab',  "freelancerppe\Controller\UserController::tabUserAction")->bind('userstab');
/**
 *                                                                  AJOUT
 *                                      route pour l'affichage du formulaire d ajout d utilisateurs
 */
$app->get('/admin/adduser', "freelancerppe\Controller\UserController::addIndexAction")->bind('adduser');
//* route pour la soumission du formulaire d ajout d utilisateurs
$app->post('/admin/adduser', "freelancerppe\Controller\UserController::addAction")->bind('user_added');
/**
 *                                                                  LISTE
 */
$app->get('/userslist', "freelancerppe\Controller\UserController::listUserIndexAction")->bind('userslist');
// liste des utilisateurs  renvoyant l'id selectionné à la fonction modifier
$app->post('/userslist', "freelancerppe\Controller\UserController::listUserAction")->bind('users');
/**
 *                                                               MODIFICATION
 */
$app->post('/admin/user/edit', "freelancerppe\Controller\UserController::editUserAction")->bind('user_edit');
/*
         *                                                       SUPPRESSION
 */
$app->match('/user_delete', "freelancerppe\Controller\UserController::deleteUserIndexAction")->bind('user_delete');
$app->post('/user_delete/id', "freelancerppe\Controller\UserController::deleteUserAction")->bind('user_deleted');



/**
 *
 *
 *               FREELANCER
 *
 *                                                            TABLEAU DE BORD
 *                                            Routes pour la gestion des freelancers
 */
/**
 *                                                                AJOUT
 *                                      route pour l'affichage du template de l'ajout des freelancers
 *                                         avec l'affichage des projets dans la liste déroulante
 */
$app->get('/addfreelancer', "freelancerppe\Controller\FreelancerController::addIndexAction")->bind('addfreelancer');
$app->post('/addfreelancer', "freelancerppe\Controller\FreelancerController::addAction")->bind('freelancer');
/**
 *                                                                LISTE
 *                                            route pour l'affichage de la liste des etudiants
 */
$app->get('/freelancerslist',"freelancerppe\Controller\FreelancerController::listIndexAction")->bind('freelancerslist');
/**
 *                                                             SUPPRESSION
 *                                            route pour la suppression d'un étudiant par l'id
 */
$app->match('/freelancer_delete', "freelancerppe\Controller\FreelancerController::deleteFreelancerIndexAction")->bind('freelancer_delete');
$app->post('/freelancer_delete/id', "freelancerppe\Controller\FreelancerController::deleteFreelancerAction")->bind('freelancer_deleted');

/**
 *                                                              MODIFICATION
 *                                              route pour modifier un étudiant par l'id
 */
$app->post('/freelancer_edit', "freelancerppe\Controller\FreelancerController::editFreelancerIndexAction")->bind('freelancer_edit');
/**
 *                                                              STATISTIQUES
 *                                            route pour l'affichage de la liste des etudiants
 */
$app->get('/freelancerstats',  "freelancerppe\Controller\FreelancerController::freelancerStatIndex")->bind('freelancerstats');




/**
 *
 *
 *           SOCIETES
 *
 *                                                                 AJOUT
 */
$app->get('/addsociete', "freelancerppe\Controller\SocieteController::addIndexAction")->bind('societe');
$app->post('/addsociete/id', "freelancerppe\Controller\SocieteController::addAction")->bind('addsociete');
/**
 *                                                                 LISTE
 */
$app->get('/societelist', "freelancerppe\Controller\SocieteController::listIndexAction")->bind('societelist');
/**
 *                                                               MODIFICATION
 */
$app->post('/societe/edit', "freelancerppe\Controller\SocieteController::editSocieteIndexAction")->bind('societe_edit');
/**
 *                                                              SUPPRESSION
 *                                          route pour la suppression d'un professeur par l'id
 */
$app->match('/societe_delete', "freelancerppe\Controller\SocieteController::deleteSocieteIndexAction")->bind('societe_delete');
$app->post('/societe_delete/id', "freelancerppe\Controller\SocieteController::deleteSocieteAction")->bind('societe_deleted');



/**
 *
 *
 *             PROJETS
 *
 *                                                 TABLEAU DE BORD DE GESTION DES PROJETS
 */
$app->match('/projettab', "freelancerppe\Controller\ProjetController::indexAction")->bind('projettab');
/**
 *                                                                  AJOUT
 *                                                      route pour l'ajout des projets
 */
$app->get('/addprojet', "freelancerppe\Controller\ProjetController::addIndexAction")->bind('addprojet');
$app->post('/addprojet', "freelancerppe\Controller\ProjetController::addAction")->bind('projet');
/**
 *                                                                  LISTE
 *                                               route pour l'affichage de la liste des projets
 */
$app->get('/projetslist', "freelancerppe\Controller\ProjetController::listIndexAction")->bind('projetslist');
/**
 *                                                                 MODIFICATION
 *                                                    route pour modifier une projet
 */
$app->post('/projet/edit', "freelancerppe\Controller\ProjetController::editProjetAction")->bind('projet_edit');
/**
 *                                                                SUPPRESSION
 *                                                route pour la suppression d'une projet par l'id
 */
$app->match('/projetname_delete', "freelancerppe\Controller\ProjetController::deleteProjetIndexAction")->bind('projetname_delete');
$app->post('/projetname_delete/id', "freelancerppe\Controller\ProjetController::deleteProjetAction")->bind('projetname_deleted');
/**
 *                                                                LISTE DES ELEVES
 *                                                route pour la liste des élèves, par l'id de la projet
 */
$app->post('/projet/listFreelancer', "freelancerppe\Controller\ProjetController::listFreelancerIndexAction")->bind('projetname_list');
$app->post('/projet/freelancer_edit', "freelancerppe\Controller\ProjetController::updateFreelancerAction")->bind('updatefreelancer');
$app->match('/projet/delete', "freelancerppe\Controller\FreelancerController::deleteFreelancerAction")->bind('deletefreelancer');
/**
 *                                                                STATISTIQUES ELEVE
 *                                                route pour les statistiques de l'étudiant, par l'id de l'étudiant
 */
$app->match('stats/statByFreelancer', "freelancerppe\Controller\FreelancerController::statByFreelancerIndexAction")->bind('statByFreelancer');
/**
 *
 *
 *           COMPETENCES
 *
 *                                                              TABLEAU DE BORD
 */
$app->get('/competencetab',  "freelancerppe\Controller\CompetenceController::tabCompetenceAction")->bind('competencetab');
/**
 *                                                                  AJOUT
 *                                                      route pour l'ajout des matières
 */
$app->get('/addcompetence', "freelancerppe\Controller\CompetenceController::addIndexAction" )->bind('addcompetence');
$app->post('addcompetence', "freelancerppe\Controller\CompetenceController::addAction")->bind('post_addcompetence');
/**
 *                                                                  LISTE
 *                                                route pour l'affichage de la liste des matières
 */
$app->get('/competenceslist', "freelancerppe\Controller\CompetenceController::listCompetenceIndexAction")->bind('competenceslist');
$app->post('/competenceslist', "freelancerppe\Controller\CompetenceController::listCompetenceAction")->bind('post_list_competences');
/**
 *                                                               MODIFICATION
 *                                                  route pour la modification des matières
 */
$app->post('/competence/edit', "freelancerppe\Controller\CompetenceController::editCompetenceAction" )->bind('competence_edit');
/**
 *                                                                SUPPRESSION
 *                                                  route pour la modification des matières
 */
$app->match('/competence_delete', "freelancerppe\Controller\CompetenceController::deleteCompetenceIndexAction" )->bind('competence_delete');
$app->post('competence_delete/delete', "freelancerppe\Controller\CompetenceController::deleteCompetenceAction")->bind('competence_deleted');


/**
 *
 *
 *            TESTS
 *
 *                                                                  AJOUT
 */

$app->get('/addtest', "freelancerppe\Controller\TestController::addIndexAction")->bind('addtest');
$app->post('/added_test', "freelancerppe\Controller\TestController::addAction")->bind('added_test');
/**
 *                                                                  LISTE
 *                                              route pour l'affichage de la liste des testen
 */
$app->match('/testslist',"freelancerppe\Controller\TestController::indexAction")->bind('testslist');
$app->post('/testslist/id',"freelancerppe\Controller\TestController::editTestIndexAction")->bind('testlist_added');
/**
 *                                                               MODIFICATION
 */
$app->post('/test_edit', "freelancerppe\Controller\TestController::editTestIndexAction")->bind('test_edit');
$app->post('/test_edit/id', "freelancerppe\Controller\TestController::editTestAction")->bind('test_edited');
/**
 *                                                              SUPPRESSION
 */
$app->match('/test_delete', "freelancerppe\Controller\TestController::deleteTestIndexAction")->bind('test_delete');
$app->post('/test_delete/id', "freelancerppe\Controller\TestController::deleteTestAction")->bind('test_deleted');


/**
 *
 *
 *            MESSAGES
 *
 *                                                                  AJOUT
 */

$app->get('/addmessage', "freelancerppe\Controller\MessageController::addIndexAction")->bind('addmessage');
$app->post('/added_message', "freelancerppe\Controller\MessageController::addAction")->bind('added_message');
/**
 *                                                                  LISTE
 *                                              route pour l'affichage de la liste des messages
 */
$app->match('/messageslist',"freelancerppe\Controller\MessageController::indexAction")->bind('messageslist');
$app->post('/messageslist/id',"freelancerppe\Controller\MessageController::editMessageIndexAction")->bind('messageslist_added');
/**
 *                                                               MODIFICATION
 */
$app->post('/message_edit', "freelancerppe\Controller\MessageController::editMessageIndexAction")->bind('message_edit');
$app->post('/message_edit/id', "freelancerppe\Controller\MessageController::editMessageAction")->bind('message_edited');
/**
 *                                                              SUPPRESSION
 */
$app->match('/message_delete', "freelancerppe\Controller\MessageController::deleteMessageIndexAction")->bind('message_delete');
$app->post('/message_delete/id', "freelancerppe\Controller\MessageController::deleteMessageAction")->bind('message_deleted');



/**
 *
 *
 *            CONTRATS
 *
 *                                                                  AJOUT
 */

$app->get('/addcontrat', "freelancerppe\Controller\ContratController::addIndexAction")->bind('addcontrat');
$app->post('/added_contrat', "freelancerppe\Controller\ContratController::addAction")->bind('added_contrat');
/**
 *                                                                  LISTE
 *                                              route pour l'affichage de la liste des messages
 */
$app->match('/contratslist',"freelancerppe\Controller\ContratController::indexAction")->bind('contratslist');
$app->post('/contratslist/id',"freelancerppe\Controller\ContratController::editContratIndexAction")->bind('contratslist_added');
/**
 *                                                               MODIFICATION
 */
$app->post('/contrat_edit', "freelancerppe\Controller\MessageController::editContratIndexAction")->bind('contrat_edit');
$app->post('/contrat_edit/id', "freelancerppe\Controller\MessageController::editContratAction")->bind('contrat_edited');
/**
 *                                                              SUPPRESSION
 */
$app->match('/contrat_delete', "freelancerppe\Controller\ContratController::deleteContratIndexAction")->bind('contrat_delete');
$app->post('/contrat_delete/id', "freelancerppe\Controller\ContratController::deleteContratAction")->bind('contrat_deleted');



/**
 *
 *
 *            OFFRES
 *
 *                                                                  AJOUT
 */

$app->get('/addoffre', "freelancerppe\Controller\OffreController::addIndexAction")->bind('addoffre');
$app->post('/added_offre', "freelancerppe\Controller\OffreController::addAction")->bind('added_offre');
/**
 *                                                                  LISTE
 *                                              route pour l'affichage de la liste des messages
 */
$app->match('/offreslist',"freelancerppe\Controller\OffreController::indexAction")->bind('offreslist');
$app->post('/offreslist/id',"freelancerppe\Controller\OffreController::editContratIndexAction")->bind('offreslist_added');
/**
 *                                                               MODIFICATION
 */
$app->post('/offre_edit', "freelancerppe\Controller\OffreController::editOffreIndexAction")->bind('offre_edit');
$app->post('/offre_edit/id', "freelancerppe\Controller\OffreController::editOffreAction")->bind('offre_edited');
/**
 *                                                              SUPPRESSION
 */
$app->match('/offre_delete', "freelancerppe\Controller\OffreController::deleteOffreIndexAction")->bind('offre_delete');
$app->post('/offre_delete/id', "freelancerppe\Controller\OffreController::deleteOffreAction")->bind('offre_deleted');


/**
 *
 *
 *            CAHIERS DES CHARGES
 *
 *                                                                  AJOUT
 */

$app->get('/addcahierdescharges', "freelancerppe\Controller\CahierdeschargesController::addIndexAction")->bind('addcahierdescharges');
$app->post('/added_cahierdescharges', "freelancerppe\Controller\CahierdeschargesController::addAction")->bind('added_cahierdescharges');
/**
 *                                                                  LISTE
 *                                              route pour l'affichage de la liste des messages
 */
$app->match('/cahierdeschargeslist',"freelancerppe\Controller\CahierdeschargesController::indexAction")->bind('cahierdeschargeslist');
$app->post('/cahierdeschargeslist/id',"freelancerppe\Controller\CahierdeschargesController::editCahierdeschargesIndexAction")->bind('cahierdeschargeslist_added');
/**
 *                                                               MODIFICATION
 */
$app->post('/cahierdescharges_edit', "freelancerppe\Controller\CahierdeschargesController::editCahierdeschargesIndexAction")->bind('cahierdescharges_edit');
$app->post('/cahierdescharges_edit/id', "freelancerppe\Controller\CahierdeschargesOffreController::editCahierdeschargesAction")->bind('cahierdescharges_edited');
/**
 *                                                              SUPPRESSION
 */
$app->match('/cahierdescharges_delete', "freelancerppe\Controller\CahierdeschargesController::deleteCahierdeschargesIndexAction")->bind('cahierdescharges_delete');
$app->post('/cahierdescharges_delete/id', "freelancerppe\Controller\CahierdeschargesController::deleteCahierdeschargesAction")->bind('cahierdescharges_deleted');