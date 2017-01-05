<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\Freelancer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Freelancer controller.
 *
 * @Route("freelancer")
 */
class FreelancerController extends Controller
{
    /**
     * Lists all freelancer entities.
     *
     * @Route("/", name="freelancer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $freelancers = $em->getRepository('MyFOSUserBundle:Freelancer')->findAll();

        return $this->render('freelancer/index.html.twig', array(
            'freelancers' => $freelancers,
        ));
    }

    public function uploadAction()
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $form['cv']->getData()->move($dir, $someNewFilename);
            $form['logo']->getData()->move($dir, $someNewFilename);
            
            $extension = $file->guessExtension();
            if (!$extension) {
                // extension cannot be guessed
                $extension = 'bin';
            }
            $file->move($dir, rand(1, 99999).'.'.$extension);
        }
    }
    
    /**
     * Creates a new freelancer entity.
     *
     * @Route("/new", name="freelancer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $freelancer = new Freelancer();
        $form = $this->createForm('MyFOSUserBundle\Form\FreelancerType', $freelancer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($freelancer);
            $em->flush($freelancer);

            return $this->redirectToRoute('freelancer_show', array('id' => $freelancer->getId()));
        }

        return $this->render('freelancer/new.html.twig', array(
            'freelancer' => $freelancer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a freelancer entity.
     *
     * @Route("/{id}", name="freelancer_show")
     * @Method("GET")
     */
    public function showAction(Freelancer $freelancer)
    {
        $deleteForm = $this->createDeleteForm($freelancer);

        return $this->render('freelancer/show.html.twig', array(
            'freelancer' => $freelancer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing freelancer entity.
     *
     * @Route("/{id}/edit", name="freelancer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Freelancer $freelancer)
    {
        $deleteForm = $this->createDeleteForm($freelancer);
        $editForm = $this->createForm('MyFOSUserBundle\Form\FreelancerType', $freelancer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('freelancer_edit', array('id' => $freelancer->getId()));
        }

        return $this->render('freelancer/edit.html.twig', array(
            'freelancer' => $freelancer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a freelancer entity.
     *
     * @Route("/{id}", name="freelancer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Freelancer $freelancer)
    {
        $form = $this->createDeleteForm($freelancer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($freelancer);
            $em->flush($freelancer);
        }

        return $this->redirectToRoute('freelancer_index');
    }

    /**
     * Creates a form to delete a freelancer entity.
     *
     * @param Freelancer $freelancer The freelancer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Freelancer $freelancer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('freelancer_delete', array('id' => $freelancer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
