<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\Contrat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Contrat controller.
 *
 * @Route("contrat")
 */
class ContratController extends Controller {

    /**
     * Lists all contrat entities.
     *
     * @Route("/", name="contrat_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $contrats = $em->getRepository('MyFOSUserBundle:Contrat')->findAll();

        return $this->render('contrat/index.html.twig', array(
                    'contrats' => $contrats,
        ));
    }

    /**
     * Creates a new contrat entity.
     *
     * @Route("/new", name="contrat_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $contrat = new Contrat();
        $form = $this->createForm('MyFOSUserBundle\Form\ContratType', $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contrat);
            $em->flush($contrat);

            return $this->redirectToRoute('contrat_show', array('id' => $contrat->getId()));
        }

        return $this->render('contrat/new.html.twig', array(
                    'contrat' => $contrat,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a contrat entity.
     *
     * @Route("/{id}", name="contrat_show")
     * @Method("GET")
     */
    public function showAction(Contrat $contrat) {
        $deleteForm = $this->createDeleteForm($contrat);

        return $this->render('contrat/show.html.twig', array(
                    'contrat' => $contrat,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing contrat entity.
     *
     * @Route("/{id}/edit", name="contrat_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Contrat $contrat) {
        $deleteForm = $this->createDeleteForm($contrat);
        $editForm = $this->createForm('MyFOSUserBundle\Form\ContratType', $contrat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contrat_edit', array('id' => $contrat->getId()));
        }

        return $this->render('contrat/edit.html.twig', array(
                    'contrat' => $contrat,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a contrat entity.
     *
     * @Route("/{id}", name="contrat_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Contrat $contrat) {
        $form = $this->createDeleteForm($contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contrat);
            $em->flush($contrat);
        }

        return $this->redirectToRoute('contrat_index');
    }

    /**
     * Creates a form to delete a contrat entity.
     *
     * @param Contrat $contrat The contrat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Contrat $contrat) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('contrat_delete', array('id' => $contrat->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
