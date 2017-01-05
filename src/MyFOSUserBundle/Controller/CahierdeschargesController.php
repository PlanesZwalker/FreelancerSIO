<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\Cahierdescharges;
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
     * Lists all cahierdescharge entities.
     *
     * @Route("/", name="cahierdescharges_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cahierdescharges = $em->getRepository('MyFOSUserBundle:Cahierdescharges')->findAll();

        return $this->render('cahierdescharges/index.html.twig', array(
            'cahierdescharges' => $cahierdescharges,
        ));
    }

    /**
     * Creates a new cahierdescharge entity.
     *
     * @Route("/new", name="cahierdescharges_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cahierdescharge = new Cahierdescharge();
        $form = $this->createForm('MyFOSUserBundle\Form\CahierdeschargesType', $cahierdescharge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cahierdescharge);
            $em->flush($cahierdescharge);

            return $this->redirectToRoute('cahierdescharges_show', array('id' => $cahierdescharge->getId()));
        }

        return $this->render('cahierdescharges/new.html.twig', array(
            'cahierdescharge' => $cahierdescharge,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cahierdescharge entity.
     *
     * @Route("/{id}", name="cahierdescharges_show")
     * @Method("GET")
     */
    public function showAction(Cahierdescharges $cahierdescharge)
    {
        $deleteForm = $this->createDeleteForm($cahierdescharge);

        return $this->render('cahierdescharges/show.html.twig', array(
            'cahierdescharge' => $cahierdescharge,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cahierdescharge entity.
     *
     * @Route("/{id}/edit", name="cahierdescharges_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cahierdescharges $cahierdescharge)
    {
        $deleteForm = $this->createDeleteForm($cahierdescharge);
        $editForm = $this->createForm('MyFOSUserBundle\Form\CahierdeschargesType', $cahierdescharge);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cahierdescharges_edit', array('id' => $cahierdescharge->getId()));
        }

        return $this->render('cahierdescharges/edit.html.twig', array(
            'cahierdescharge' => $cahierdescharge,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cahierdescharge entity.
     *
     * @Route("/{id}", name="cahierdescharges_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Cahierdescharges $cahierdescharge)
    {
        $form = $this->createDeleteForm($cahierdescharge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cahierdescharge);
            $em->flush($cahierdescharge);
        }

        return $this->redirectToRoute('cahierdescharges_index');
    }

    /**
     * Creates a form to delete a cahierdescharge entity.
     *
     * @param Cahierdescharges $cahierdescharge The cahierdescharge entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cahierdescharges $cahierdescharge)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cahierdescharges_delete', array('id' => $cahierdescharge->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
