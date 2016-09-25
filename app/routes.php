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
 *                PARENT
 *
 *                                                   route pour afficher le layout parent
 */
$app->get('/profilparent', "freelancerppe\Controller\ParentController::afficheProfilParentAction")->bind('parent');
/**
 *                                                   route pour afficher le profil parent
 */
$app->get('/profilstudent', "freelancerppe\Controller\ParentController::afficheProfilStudentAction")->bind('profil_parent');
/**
 *
 *
 *               FREELANCER
 *
 *                                                            TABLEAU DE BORD
 *                                            Routes pour la gestion des etudiants
 */
/**
 *                                                                AJOUT
 *                                      route pour l'affichage du template de l'ajout des étudiants
 *                                         avec l'affichage des classes dans la liste déroulante
 */
$app->get('/addstudent', "freelancerppe\Controller\StudentController::addIndexAction")->bind('addstudent');
$app->post('/addstudent', "freelancerppe\Controller\StudentController::addAction")->bind('student');
/**
 *                                                                LISTE
 *                                            route pour l'affichage de la liste des etudiants
 */
$app->get('/studentslist',"freelancerppe\Controller\StudentController::listIndexAction")->bind('studentslist');
/**
 *                                                             SUPPRESSION
 *                                            route pour la suppression d'un étudiant par l'id
 */
$app->match('/student_delete', "freelancerppe\Controller\StudentController::deleteStudentIndexAction")->bind('student_delete');
$app->post('/student_delete/id', "freelancerppe\Controller\StudentController::deleteStudentAction")->bind('student_deleted');

/**
 *                                                              MODIFICATION
 *                                              route pour modifier un étudiant par l'id
 */
$app->post('/student_edit', "freelancerppe\Controller\StudentController::editStudentIndexAction")->bind('student_edit');
/**
 *                                                              STATISTIQUES
 *                                            route pour l'affichage de la liste des etudiants
 */
$app->get('/studentstats',  "freelancerppe\Controller\StudentController::studentStatIndex")->bind('studentstats');
/**
 *
 *
 *           STATUT FREELANCER
 *
 *                                                              AJOUT
 */
$app->get('/addstatutstudent', "freelancerppe\Controller\StatutStudentController::addIndexAction")->bind('statut');
$app->post('/addstatutstudent/', "freelancerppe\Controller\StatutStudentController::addAction")->bind('addstatut');
/**
 *                                                             SUPPRIMER
 *                                              route pour supprimer un statut
 */
$app->match('/statutstudent_delete', "freelancerppe\Controller\StatutStudentController::deleteIndexAction")->bind('statut_delete');
$app->post('/statutstudent_delete/id', "freelancerppe\Controller\StatutStudentController::deleteAction")->bind('statut_deleted');
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
 *             PROJETS
 *
 *                                                 TABLEAU DE BORD DE GESTION DES PROJETS
 */
$app->match('/classetab', "freelancerppe\Controller\ClassNameController::indexAction")->bind('classetab');
/**
 *                                                                  AJOUT
 *                                                      route pour l'ajout des classes
 */
$app->get('/addclass', "freelancerppe\Controller\ClassNameController::addIndexAction")->bind('addclass');
$app->post('/addclass', "freelancerppe\Controller\ClassNameController::addAction")->bind('class');
/**
 *                                                                  LISTE
 *                                               route pour l'affichage de la liste des classes
 */
$app->get('/classeslist', "freelancerppe\Controller\ClassNameController::listIndexAction")->bind('classeslist');
/**
 *                                                                 MODIFICATION
 *                                                    route pour modifier une classe
 */
$app->post('/class/edit', "freelancerppe\Controller\ClassNameController::editClassNameAction")->bind('class_edit');
/**
 *                                                                SUPPRESSION
 *                                                route pour la suppression d'une classe par l'id
 */
$app->match('/classname_delete', "freelancerppe\Controller\ClassNameController::deleteClassNameIndexAction")->bind('classname_delete');
$app->post('/classname_delete/id', "freelancerppe\Controller\ClassNameController::deleteClassNameAction")->bind('classname_deleted');
/**
 *                                                                LISTE DES ELEVES
 *                                                route pour la liste des élèves, par l'id de la classe
 */
$app->post('/class/listStudent', "freelancerppe\Controller\ClassNameController::listStudentIndexAction")->bind('classname_list');
$app->post('/class/student_edit', "freelancerppe\Controller\ClassNameController::updateStudentAction")->bind('updatestudent');
$app->match('/class/delete', "freelancerppe\Controller\StudentController::deleteStudentAction")->bind('deletestudent');
/**
 *                                                                STATISTIQUES ELEVE
 *                                                route pour les statistiques de l'étudiant, par l'id de l'étudiant
 */
$app->match('stats/statByStudent', "freelancerppe\Controller\StudentController::statByStudentIndexAction")->bind('statByStudent');
/**
 *
 *
 *           DISCIPLINES
 *
 *                                                              TABLEAU DE BORD
 */
$app->get('/disciplinetab',  "freelancerppe\Controller\DisciplineController::tabDisciplineAction")->bind('disciplinetab');
/**
 *                                                                  AJOUT
 *                                                      route pour l'ajout des matières
 */
$app->get('/adddiscipline', "freelancerppe\Controller\DisciplineController::addIndexAction" )->bind('adddiscipline');
$app->post('adddiscipline', "freelancerppe\Controller\DisciplineController::addAction")->bind('post_adddiscipline');
/**
 *                                                                  LISTE
 *                                                route pour l'affichage de la liste des matières
 */
$app->get('/disciplineslist', "freelancerppe\Controller\DisciplineController::listDisciplineIndexAction")->bind('disciplineslist');
$app->post('/disciplineslist', "freelancerppe\Controller\DisciplineController::listDisciplineAction")->bind('post_list_disciplines');
/**
 *                                                               MODIFICATION
 *                                                  route pour la modification des matières
 */
$app->post('/discipline/edit', "freelancerppe\Controller\DisciplineController::editDisciplineAction" )->bind('discipline_edit');
/**
 *                                                                SUPPRESSION
 *                                                  route pour la modification des matières
 */
$app->match('/discipline_delete', "freelancerppe\Controller\DisciplineController::deleteDisciplineIndexAction" )->bind('discipline_delete');
$app->post('discipline_delete/delete', "freelancerppe\Controller\DisciplineController::deleteDisciplineAction")->bind('discipline_deleted');
/**
 *
 *
 *             EVALUATION
 *
 *                                                     TABLEAU DE BORD STATS DES NOTES
 */
$app->get('/notetab', "freelancerppe\Controller\EvaluationController::tabAction")->bind('notetab');
/**
 *                                                                AJOUT
 *                                              Route pour l'ajout des notes et commentaires
 */
$app->get('/notelist',"freelancerppe\Controller\EvaluationController::addIndexAction")->bind('note');
$app->post('/addnote',"freelancerppe\Controller\EvaluationController::addAction")->bind('addnote');
/**
 *                                                                 LISTE
 *                                         route pour l'affichage de la liste des notes - evaluations
 */
$app->post('/notelist',"freelancerppe\Controller\EvaluationController::addIndexAction")->bind('notelist');
/**
 *                                                               MODIFICATION
 */
$app->match('/note_edit', "freelancerppe\Controller\EvaluationController::editEvaluationIndexAction")->bind('note_edit');
$app->match('/edit/id', "freelancerppe\Controller\EvaluationController::editEvaluationAction")->bind('note_edited');
/**
 *                                                              STATISTIQUES
 *                                                  route pour afficher les stats des notes
 */
$app->post('/notestats',"freelancerppe\Controller\EvaluationController::statAction")->bind('notestats');
$app->post('/listnote',"freelancerppe\Controller\EvaluationController::listNoteAction")->bind('listnote');
/**
 *
 *
 *            TEST
 *
 *                                                                  AJOUT
 */

$app->get('/addexam', "freelancerppe\Controller\ExamenController::addIndexAction")->bind('addexam');
$app->post('/added_exam', "freelancerppe\Controller\ExamenController::addAction")->bind('added_exam');
/**
 *                                                                  LISTE
 *                                              route pour l'affichage de la liste des examen
 */
$app->match('/examlist',"freelancerppe\Controller\ExamenController::indexAction")->bind('examlist');
$app->post('/examlist/id',"freelancerppe\Controller\ExamenController::editStudentIndexAction")->bind('examlist_added');
/**
 *                                                               MODIFICATION
 */
$app->post('/exam_edit', "freelancerppe\Controller\ExamenController::editExamenIndexAction")->bind('exam_edit');
$app->post('/exam_edit/id', "freelancerppe\Controller\ExamenController::editExamenAction")->bind('exam_edited');
/**
 *                                                              SUPPRESSION
 */
$app->match('/exam_delete', "freelancerppe\Controller\ExamenController::deleteExamenIndexAction")->bind('exam_delete');
$app->post('/exam_delete/id', "freelancerppe\Controller\ExamenController::deleteExamenAction")->bind('exam_deleted');
/**
 *
 *
 *           SOCIETES
 *
 *                                                                 AJOUT
 */
$app->get('/addteacher', "freelancerppe\Controller\TeacherController::addIndexAction")->bind('teacher');
$app->post('/addteacher/id', "freelancerppe\Controller\TeacherController::addAction")->bind('addteacher');
/**
 *                                                                 LISTE
 */
$app->get('/teacherlist', "freelancerppe\Controller\TeacherController::listIndexAction")->bind('teacherlist');
/**
 *                                                               MODIFICATION
 */
$app->post('/teacher/edit', "freelancerppe\Controller\TeacherController::editTeacherIndexAction")->bind('teacher_edit');
/**
 *                                                              SUPPRESSION
 *                                          route pour la suppression d'un professeur par l'id
 */
$app->match('/teacher_delete', "freelancerppe\Controller\TeacherController::deleteTeacherIndexAction")->bind('teacher_delete');
$app->post('/teacher_delete/id', "freelancerppe\Controller\TeacherController::deleteTeacherAction")->bind('teacher_deleted');

/* mot de passe */
$app->match('/mdp', "freelancerppe\Controller\AdminController::mdpIndexAction")->bind('mdp');