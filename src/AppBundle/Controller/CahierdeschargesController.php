<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cahierdescharges;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Cahierdescharge controller.
 *
 * @Route("cahierdescharges")
 */
class CahierdeschargesController extends Controller
{
    /**
     * Lists all cahierdescharges entities.
     *
     * @Route("/", name="cahierdescharges_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cahierdescharges = $em->getRepository('AppBundle:Cahierdescharges')->findAll();

        return $this->render('cahierdescharges/index.html.twig', array(
            'cahierdescharges' => $cahierdescharges,
        ));
    }

    /**
     * Creates a new cahierdescharges entity.
     *
     * @Route("/new", name="cahierdescharges_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cahierdescharges = new Cahierdescharges();
        $form = $this->createForm('AppBundle\Form\CahierdeschargesType', $cahierdescharges);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cahierdescharges);
            $em->flush($cahierdescharges);

            return $this->redirectToRoute('cahierdescharges_show', array('id' => $cahierdescharge->getIdCdc()));
        }

        return $this->render('cahierdescharges/new.html.twig', array(
            'cahierdescharge' => $cahierdescharges,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cahierdescharges entity.
     *
     * @Route("/{id}", name="cahierdescharges_show")
     * @Method("GET")
     */
    public function showAction(Cahierdescharges $cahierdescharges)
    {
        $deleteForm = $this->createDeleteForm($cahierdescharges);

        return $this->render('cahierdescharges/show.html.twig', array(
            'cahierdescharges' => $cahierdescharges,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cahierdescharges entity.
     *
     * @Route("/{id}/edit", name="cahierdescharges_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cahierdescharges $cahierdescharges)
    {
        $deleteForm = $this->createDeleteForm($cahierdescharges);
        $editForm = $this->createForm('AppBundle\Form\CahierdeschargesType', $cahierdescharges);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cahierdescharges_edit', array('id' => $cahierdescharge->getIdCdc()));
        }

        return $this->render('cahierdescharges/edit.html.twig', array(
            'cahierdescharge' => $cahierdescharges,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cahierdescharges entity.
     *
     * @Route("/{id}", name="cahierdescharges_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Cahierdescharges $cahierdescharges)
    {
        $form = $this->createDeleteForm($cahierdescharges);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cahierdescharges);
            $em->flush($cahierdescharges);
        }

        return $this->redirectToRoute('cahierdescharges_index');
    }

    /**
     * Creates a form to delete a cahierdescharges entity.
     *
     * @param Cahierdescharges $cahierdescharges The cahierdescharges entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cahierdescharges $cahierdescharges)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cahierdescharges_delete', array('id' => $cahierdescharges->getIdCdc())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
