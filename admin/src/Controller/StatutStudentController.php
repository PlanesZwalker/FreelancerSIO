<?php
/**
 * Created by PhpStorm.
 * User: Singu_Admin
 * Date: 12/03/2016
 * Time: 16:13
 */

/**
 * Controller des statuts étudiants
 *
 * TODO: A voir pour peut être les mettre dans le controller admin...
 *
 */
namespace freelancerppe\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use freelancerppe\Domain\StatutStudent;


class StatutStudentController
{
    public function addIndexAction(Request $request ,Application $app) {
        $statuts = $app['dao.statutStudent']->findAll();

        return $app['twig']->render('FormTemplate/addstatut.html.twig', array(
            'statuts' => $statuts
        ));
    }

    /*public function editAction($id, Application $app)
    {
        $statut = $app['dao.statutStudent']->findStatut($id);

        return $app['twig']->render('FormTemplate/addstatut.html.twig', array(
            'statut' => $statut,
        ));


    }*/

    public function addAction(Request $request ,Application $app){

        $newStatut = new StatutStudent();

        $newStatut->setStatutStudent($request->request->get('statut'));
        $newStatut->setDtCreate(date('Y-m-d H:i:s'));
        $newStatut->setDtUpdate(date('Y-m-d H:i:s'));

        $app['dao.statutStudent']->saveStatutStudent($newStatut);

        $app['session']->getFlashBag()->add('success', 'Le statut a bien été ajouté !'); //message flash de success

        return $app['twig']->render('FormTemplate/addstatut.html.twig');
    }
}