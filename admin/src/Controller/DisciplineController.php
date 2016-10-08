<?php

namespace freelancerppe\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use freelancerppe\Domain\Discipline;

/**
 * Description of DisciplineController
 *
 * @author ajj
 */
class DisciplineController {
 
    
    
/**                                                            DISCIPLINES
 * 
 *  
 *                   TABLEAU DE BORD
 * 
 */
public function tabDisciplineAction(Application $app) {
    return $app['twig']->render('TabTemplate/disciplinetab.html.twig');
}
/**   *                       LISTE
 * 
 * route pour l'affichage de la liste des matières
 */
public function listDisciplineIndexAction(Application $app) {
    
  //  $classes = $app['dao.className']->findAll();
    $disciplines = $app['dao.discipline']->findAll();

  //  $users = $app['dao.user']->findAll();
     
    return $app['twig']->render('ListTemplate/disciplineslist.html.twig', array(
  //      'classes'=>$classes,
        'disciplines'=>$disciplines,
  //      'users'=>$users,
    ));
}

public function listDisciplineAction(Application $app) {
    
   // $classes = $app['dao.className']->findAll();
    $disciplines = $app['dao.discipline']->findAll();
   // $users = $app['dao.user']->findAll();

    return $app['twig']->render('ListTemplate/disciplineslist.html.twig', array(
        'classes'=>$classes,
        'disciplines'=>$disciplines,
        'users'=>$users,
    ));
}

/**                    AJOUT
 *
 * route pour l'ajout des matières
 */ 
   public function addIndexAction(Request $request, Application $app) {
    
        return $app['twig']->render('FormTemplate/adddiscipline.html.twig');
    }

    public function addAction(Request $request, Application $app) {
        
        $newDiscipline = new Discipline();

        if(null !== $request->request->get('id_discipline'))
        {
            $newDiscipline->setIdDiscipline($request->request->get('id_discipline'));
        }

        $newDiscipline->setNameDiscipline($request->request->get('matiere'));
        $newDiscipline->setDescription($request->request->get('description'));
        $newDiscipline->setDtCreate(date('Y-m-d H:i:s'));
        $newDiscipline->setDtUpdate(date('Y-m-d H:i:s'));

        $app['dao.discipline']->saveDiscipline($newDiscipline);


        if(null !== $request->request->get('id_discipline')) {
            $app['session']->getFlashBag()->add('success', 'La compétence a été modifée avec succès !');

            return $app->redirect($app['url_generator']->generate('disciplineslist'));
        }
        else {
            $app['session']->getFlashBag()->add('success', 'La compétence a été ajoutée avec succès !');

            return $app->redirect($app['url_generator']->generate('disciplineslist'));
        }

    }

    public function deleteDisciplineIndexAction(Request $request, Application $app) {

        $matieres = $app['dao.discipline']->findAll();

        $app['session']->getFlashBag()->add('danger', 'La compétence a été supprimée !');

        return $app['twig']->render('ListTemplate/disciplineslist.html.twig', array(
            'disciplines' => $matieres,
        ));
    }

    public function deleteDisciplineAction(Request $request, Application $app){

        $id_discipline = $request->request->get('id_discipline');
        $newDiscipline = new Discipline();

        $newDiscipline->setIdDiscipline($id_discipline);

        $app['dao.discipline']->deleteDiscipline($newDiscipline->getIdDiscipline());

        $app['session']->getFlashBag()->add('danger', 'Compétence supprimée !');

        return $app->redirect($app['url_generator']->generate('disciplineslist'));
    }

    //MODIFICATION
    public function editDisciplineAction(Request $request, Application $app)
    {
        $id_discipline = $request->request->get('id_discipline');

        $discipline = $app['dao.discipline']->findDiscipline($id_discipline);

        return $app['twig']->render('FormTemplate/adddiscipline.html.twig', array(
            'discipline' => $discipline,
        ));
    }

}
