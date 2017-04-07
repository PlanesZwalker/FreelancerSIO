<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\Test;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Test controller.
 *
 * @Route("test")
 */
class TestController extends Controller
{
    /**
     * Lists all test entities.
     *
     * @Route("/", name="test_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tests = $em->getRepository('MyFOSUserBundle:Test')->findAll();

        return $this->render('test/index.html.twig', array(
            'tests' => $tests,
        ));
    }

    /**
     * Creates a new test entity.
     *
     * @Route("/new", name="test_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $test = new Test();
        $form = $this->createForm('MyFOSUserBundle\Form\TestType', $test);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($test);
            $em->flush($test);

            return $this->redirectToRoute('test_show', array('id' => $test->getIdTest()));
        }

        return $this->render('test/new.html.twig', array(
            'test' => $test,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a test entity.
     *
     * @Route("/{id}", name="test_show")
     * @Method("GET")
     */
    public function showAction(Test $test)
    {
        $deleteForm = $this->createDeleteForm($test);
        
        $em = $this->getDoctrine()->getManager();
           
        $user = $this->getUser();
        $myuser = $user->getId();
        var_dump($myuser);
           
        $iduser = array('user'=> $myuser);
     
        $myfreelancer =  $em->getRepository('MyFOSUserBundle:Freelancer')->findOneBy($iduser);
        $idfreelancer = $myfreelancer->getId();
        $freelancer=array('freelancer'=> $idfreelancer);// recuperer l'id de l'utilisateur en cours
        $testfreelancer = $em->getRepository('MyFOSUserBundle:Testfreelancer')->findOneBy($freelancer);
        
        $competence=array('competence'=>1);// recuperer l'id de la competence en cours
        $testcompetence = $em->getRepository('MyFOSUserBundle:Testcompetence')->findOneBy($competence);
        //$testcompetence->getCompetence();
        
        return $this->render('test/show.html.twig', array(
            'test' => $test,
            'testfreelancer' => $testfreelancer,
            'testcompetence' => $testcompetence,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing test entity.
     *
     * @Route("/{id}/edit", name="test_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Test $test)
    {
        $deleteForm = $this->createDeleteForm($test);
        $editForm = $this->createForm('MyFOSUserBundle\Form\TestType', $test);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('test_edit', array('id' => $test->getIdTest()));
        }

        return $this->render('test/edit.html.twig', array(
            'test' => $test,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a test entity.
     *
     * @Route("/{id}", name="test_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Test $test)
    {
        $form = $this->createDeleteForm($test);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($test);
            $em->flush($test);
        }

        return $this->redirectToRoute('test_index');
    }

    /**
     * Creates a form to delete a test entity.
     *
     * @param Test $test The test entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Test $test)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('test_delete', array('id' => $test->getIdTest())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
