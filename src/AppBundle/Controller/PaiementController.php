<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Paiement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Paiement controller.
 *
 * @Route("paiement")
 */
class PaiementController extends Controller
{
    /**
     * Lists all paiement entities.
     *
     * @Route("/", name="paiement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paiements = $em->getRepository('AppBundle:Paiement')->findAll();

        return $this->render('paiement/index.html.twig', array(
            'paiements' => $paiements,
        ));
    }

    /**
     * Creates a new paiement entity.
     *
     * @Route("/new", name="paiement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $paiement = new Paiement();
        $form = $this->createForm('AppBundle\Form\PaiementType', $paiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paiement);
            $em->flush($paiement);

            return $this->redirectToRoute('paiement_show', array('id' => $paiement->getid_paiement()));
        }

        return $this->render('paiement/new.html.twig', array(
            'paiement' => $paiement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a paiement entity.
     *
     * @Route("/{id}", name="paiement_show")
     * @Method("GET")
     */
    public function showAction(Paiement $paiement)
    {
        $deleteForm = $this->createDeleteForm($paiement);

        return $this->render('paiement/show.html.twig', array(
            'paiement' => $paiement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing paiement entity.
     *
     * @Route("/{id}/edit", name="paiement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Paiement $paiement)
    {
        $deleteForm = $this->createDeleteForm($paiement);
        $editForm = $this->createForm('AppBundle\Form\PaiementType', $paiement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('paiement_edit', array('id' => $paiement->getid_paiement()));
        }

        return $this->render('paiement/edit.html.twig', array(
            'paiement' => $paiement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a paiement entity.
     *
     * @Route("/{id}", name="paiement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Paiement $paiement)
    {
        $form = $this->createDeleteForm($paiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paiement);
            $em->flush($paiement);
        }

        return $this->redirectToRoute('paiement_index');
    }

    /**
     * Creates a form to delete a paiement entity.
     *
     * @param Paiement $paiement The paiement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Paiement $paiement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paiement_delete', array('id' => $paiement->getid_paiement())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
