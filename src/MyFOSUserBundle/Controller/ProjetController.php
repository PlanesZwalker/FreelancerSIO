<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\Projet;
use MyFOSUserBundle\Entity\Societe;
use MyFOSUserBundle\Entity\Cahierdescharges;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Projet controller.
 *
 * @Route("projet")
 */
class ProjetController extends Controller {

    /**
     * Lists all projet entities.
     *
     * @Route("/", name="projet_index")
     * @Method({"GET","POST"})
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        
        // la recherche se fait par une société
        if($request->get('id')){
            // on recupere l'objet societe de celui qui a publié le projet
            $id_societe = $request->get('id');
            $criteria = ["id" => $id_societe];
            $societe = $em->getRepository("MyFOSUserBundle:Societe")->findOneBy($criteria);
            // on retrouve la liste complète des projets de cette société
            $projetsBySociete = $em->getRepository("MyFOSUserBundle:Projet")->findBy($criteria);   
             
            return $this->render('projet/index.html.twig', array( 
                    'societe' => $societe,
                    'projetsBySociete' => $projetsBySociete
        ));
        }else{
             // liste complète de tous les projets
            $projets = $em->getRepository('MyFOSUserBundle:Projet')->findAll();
             
            return $this->render('projet/index.html.twig', array(
                    'projets' => $projets,
        ));
        }
      
      
     //   $offresByProjet =[];
        // on retrouve les offres associés pour chaque projet
     /*   foreach($projets as $key=>$value){

            $id_projets[$key] = $value->getId();
            
            $offresByProjet[$key] = $offres->OffresByProjetAction($id_projets[$key]);
        }
*/
       
    }

    /**
     * Creates a new projet entity.
     *
     * @Route("/new", name="projet_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $projet = new Projet();
        $societe = new Societe();

        $em = $this->getDoctrine()->getManager();
        $criteria = ['user' => $this->getUser()->getId()];
        $maSociete = $em->getRepository('MyFOSUserBundle:Societe')->findOneBy($criteria);

        $form = $this->createFormBuilder($projet)
                ->add('intitule')
                ->add('description')
                ->add('prix')
                ->add('cahierdescharges', CKEditorType::class, array(
                    'input_sync' => true,
                    'config' => array(
                        'uiColor' => '#020F58',
                    ),
                    'label' => 'Saisir les clauses du cahier des charges ici: ',
                ))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $projet->setEtat("Publié");

            $projet->setSociete($maSociete);

            $em = $this->getDoctrine()->getManager();
            $em->persist($projet);
            $em->flush($projet);

            return $this->redirectToRoute('projet_show', array('id' => $projet->getId()));
        }

        return $this->render('projet/new.html.twig', array(
                    'projet' => $projet,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projet entity.
     *
     * @Route("/{id}", name="projet_show")
     * @Method("GET")
     */
    public function showAction(Projet $projet) {
        $deleteForm = $this->createDeleteForm($projet);

        return $this->render('projet/show.html.twig', array(
                    'projet' => $projet,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a projet entity.
     *
     * @Route("/{id}", name="projet_showCdc")
     * @Method("GET")
     */
    public function showCdcAction(Projet $projet) {
        $deleteForm = $this->createDeleteForm($projet);

        return $this->render('projet/showCdc.html.twig', array(
                    'projet' => $projet,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projet entity.
     *
     * @Route("/{id}/edit", name="projet_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Projet $projet) {
        $deleteForm = $this->createDeleteForm($projet);

        $editForm = $this->createFormBuilder($projet)
                ->add('intitule')
                ->add('description')
                ->add('prix')
                ->add('etat')
                ->getForm();

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('projet_edit', array('id' => $projet->getId()));
        }

        return $this->render('projet/edit.html.twig', array(
                    'projet' => $projet,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projet entity.
     *
     * @Route("/{id}", name="projet_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Projet $projet) {
        $form = $this->createDeleteForm($projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projet);
            $em->flush($projet);
        }

        return $this->redirectToRoute('projet_index');
    }

    /**
     * Creates a form to delete a projet entity.
     *
     * @param Projet $projet The projet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Projet $projet) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('projet_delete', array('id' => $projet->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
