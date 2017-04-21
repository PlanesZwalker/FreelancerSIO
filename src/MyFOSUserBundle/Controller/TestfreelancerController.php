<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\Testfreelancer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Testfreelancer controller.
 *
 * @Route("testfreelancer")
 */
class TestfreelancerController extends Controller {

    /**
     * Lists all testfreelancer entities.
     *
     * @Route("/", name="testfreelancer_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $testfreelancers = $em->getRepository('MyFOSUserBundle:Testfreelancer')->findAll();
        return $this->render('testfreelancer/index.html.twig', array(
                    'testfreelancers' => $testfreelancers,
        ));
    }

    /**
     * Creates a new testfreelancer entity.
     *
     * @Route("/new", name="testfreelancer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $testfreelancer = new Testfreelancer();
        $form = $this->createForm('MyFOSUserBundle\Form\TestfreelancerType', $testfreelancer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($testfreelancer);
            $em->flush($testfreelancer);

            return $this->redirectToRoute('testfreelancer_show', array('id' => $testfreelancer->getId()));
        }

        return $this->render('testfreelancer/new.html.twig', array(
                    'testfreelancer' => $testfreelancer,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a testfreelancer entity.
     *
     * @Route("/{id}", name="testfreelancer_show")
     * @Method("GET")
     */
    public function showAction(Testfreelancer $testfreelancer) {
        $deleteForm = $this->createDeleteForm($testfreelancer);

        return $this->render('testfreelancer/show.html.twig', array(
                    'testfreelancer' => $testfreelancer,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing testfreelancer entity.
     *
     * @Route("/{id}/edit", name="testfreelancer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Testfreelancer $testfreelancer) {
        $deleteForm = $this->createDeleteForm($testfreelancer);
        $editForm = $this->createForm('MyFOSUserBundle\Form\TestfreelancerType', $testfreelancer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('testfreelancer_edit', array('id' => $testfreelancer->getId()));
        }

        return $this->render('testfreelancer/edit.html.twig', array(
                    'testfreelancer' => $testfreelancer,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a testfreelancer entity.
     *
     * @Route("/{id}", name="testfreelancer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Testfreelancer $testfreelancer) {
        $form = $this->createDeleteForm($testfreelancer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($testfreelancer);
            $em->flush($testfreelancer);
        }

        return $this->redirectToRoute('testfreelancer_index');
    }

    /**
     * Creates a form to delete a testfreelancer entity.
     *
     * @param Testfreelancer $testfreelancer The testfreelancer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Testfreelancer $testfreelancer) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('testfreelancer_delete', array('id' => $testfreelancer->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
