<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Admin controller.
 *
 * @Route("myadmin")
 */
class AdminController extends Controller
{
    /**
     * Lists all admin entities.
     *
     * @Route("/", name="myadmin_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $admins = $em->getRepository('AppBundle:Admin')->findAll();

        return $this->render('admin/index.html.twig', array(
            'admins' => $admins,
        ));
    }

    /**
     * Creates a new admin entity.
     *
     * @Route("/new", name="myadmin_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $admin = new Admin();
        $form = $this->createForm('AppBundle\Form\AdminType', $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($admin);
            $em->flush($admin);

            return $this->redirectToRoute('myadmin_show', array('id' => $admin->getId()));
        }

        return $this->render('admin/new.html.twig', array(
            'admin' => $admin,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a admin entity.
     *
     * @Route("/{id}", name="myadmin_show")
     * @Method("GET")
     */
    public function showAction(Admin $admin)
    {
        $deleteForm = $this->createDeleteForm($admin);

        return $this->render('admin/show.html.twig', array(
            'admin' => $admin,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing admin entity.
     *
     * @Route("/{id}/edit", name="myadmin_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Admin $admin)
    {
        $deleteForm = $this->createDeleteForm($admin);
        $editForm = $this->createForm('AppBundle\Form\AdminType', $admin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('myadmin_edit', array('id' => $admin->getId()));
        }

        return $this->render('admin/edit.html.twig', array(
            'admin' => $admin,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a admin entity.
     *
     * @Route("/{id}", name="myadmin_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Admin $admin)
    {
        $form = $this->createDeleteForm($admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($admin);
            $em->flush($admin);
        }

        return $this->redirectToRoute('myadmin_index');
    }

    /**
     * Creates a form to delete a admin entity.
     *
     * @param Admin $admin The admin entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Admin $admin)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('myadmin_delete', array('id' => $admin->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
