<?php

namespace freelancerppe\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use freelancerppe\Domain\Competence;

/**
 * Description of CompetenceController
 *
 * @author ajj
 */
class CompetenceController {
 
    
    
/**                                                            DISCIPLINES
 * 
 *  
 *                   TABLEAU DE BORD
 * 
 */
public function tabCompetenceAction(Application $app) {
    return $app['twig']->render('TabTemplate/competencetab.html.twig');
}
/**   *                       LISTE
 * 
 * route pour l'affichage de la liste des competence
 */
public function listCompetenceIndexAction(Application $app) {
    
  //  $classes = $app['dao.className']->findAll();
    $competences = $app['dao.competence']->findAll();

    $users = $app['dao.user']->findAll();
     
    return $app['twig']->render('ListTemplate/competenceslist.html.twig', array(
  //      'classes'=>$classes,
        'competences'=>$competences,
        'users'=>$users,
    ));
}

public function listCompetenceAction(Application $app) {
    
   // $classes = $app['dao.className']->findAll();
    $competences = $app['dao.competence']->findAll();
    $users = $app['dao.user']->findAll();

    return $app['twig']->render('ListTemplate/competenceslist.html.twig', array(
    //    'classes'=>$classes,
        'competences'=>$competences,
        'users'=>$users,
    ));
}

/**                    AJOUT
 *
 * route pour l'ajout des competence
 */ 
   public function addIndexAction(Request $request, Application $app) {
    
        return $app['twig']->render('FormTemplate/addcompetence.html.twig');
    }

    public function addAction(Request $request, Application $app) {
        
        $newCompetence = new Competence();

        if(null !== $request->request->get('id_competence'))
        {
            $newCompetence->setIdCompetence($request->request->get('id_competence'));
        }

        $newCompetence->setNameCompetence($request->request->get('matiere'));
        $newCompetence->setDescription($request->request->get('description'));
        $newCompetence->setDtCreate(date('Y-m-d H:i:s'));
        $newCompetence->setDtUpdate(date('Y-m-d H:i:s'));

        $app['dao.competence']->saveCompetence($newCompetence);


        if(null !== $request->request->get('id_competence')) {
            $app['session']->getFlashBag()->add('success', 'La compétence a été modifée avec succès !');

            return $app->redirect($app['url_generator']->generate('competenceslist'));
        }
        else {
            $app['session']->getFlashBag()->add('success', 'La compétence a été ajoutée avec succès !');

            return $app->redirect($app['url_generator']->generate('competenceslist'));
        }

    }

    public function deleteCompetenceIndexAction(Request $request, Application $app) {

        $matieres = $app['dao.competence']->findAll();

        $app['session']->getFlashBag()->add('danger', 'La compétence a été supprimée !');

        return $app['twig']->render('ListTemplate/competenceslist.html.twig', array(
            'competences' => $matieres,
        ));
    }

    public function deleteCompetenceAction(Request $request, Application $app){

        $id_competence = $request->request->get('id_competence');
        $newCompetence = new Competence();

        $newCompetence->setIdCompetence($id_competence);

        $app['dao.competence']->deleteCompetence($newCompetence->getIdCompetence());

        $app['session']->getFlashBag()->add('danger', 'Compétence supprimée !');

        return $app->redirect($app['url_generator']->generate('competenceslist'));
    }

    //MODIFICATION
    public function editCompetenceAction(Request $request, Application $app)
    {
        $id_competence = $request->request->get('id_competence');

        $competence = $app['dao.competence']->findCompetence($id_competence);

        return $app['twig']->render('FormTemplate/addcompetence.html.twig', array(
            'competence' => $competence,
        ));
    }

}
