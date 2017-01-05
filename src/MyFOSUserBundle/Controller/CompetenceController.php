<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\Competence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
 
/**
 * Competence controller.
 *
 * @Route("competence")
 */
class CompetenceController extends Controller
{
    /**
     * Lists all competence entities.
     *
     * @Route("/", name="competence_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $competences = $em->getRepository('MyFOSUserBundle:Competence')->findAll();

        return $this->render('competence/index.html.twig', array(
            'competences' => $competences,
        ));
    }

    /**
     * Creates a new competence entity.
     *
     * @Route("/new", name="competence_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $competence = new Competence();
        $form = $this->createForm('MyFOSUserBundle\Form\CompetenceType', $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            if($request->isXmlHttpRequest()){
                 $data = $request->request->get('data');
                 $em->setData($data);
                 $em->flush($competence);
            }else{ $em = $this->getDoctrine()->getManager();
                $em->persist($competence);
                $em->flush($competence);
            }

            return $this->redirectToRoute('competence_show', array('id' => $competence->getIdCompetence()));
        }

        return $this->render('competence/new.html.twig', array(
            'competence' => $competence,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a competence entity.
     *
     * @Route("/{id}", name="competence_show")
     * @Method("GET")
     */
    public function showAction(Competence $competence)
    {
        $deleteForm = $this->createDeleteForm($competence);

        return $this->render('competence/show.html.twig', array(
            'competence' => $competence,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing competence entity.
     *
     * @Route("/{id}/edit", name="competence_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Competence $competence)
    {
        $deleteForm = $this->createDeleteForm($competence);
        $editForm = $this->createForm('MyFOSUserBundle\Form\CompetenceType', $competence);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('competence_edit', array('id' => $competence->getIdCompetence()));
        }

        return $this->render('competence/edit.html.twig', array(
            'competence' => $competence,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a competence entity.
     *
     * @Route("/{id}", name="competence_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Competence $competence)
    {
        $form = $this->createDeleteForm($competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($competence);
            $em->flush($competence);
        }

        return $this->redirectToRoute('competence_index');
    }

    /**
     * Creates a form to delete a competence entity.
     *
     * @param Competence $competence The competence entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Competence $competence)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('competence_delete', array('id' => $competence->getIdCompetence())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
