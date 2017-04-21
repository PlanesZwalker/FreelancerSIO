<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\Societe;
use MyFOSUserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
//use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
        
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
// ...
/**
 * Societe controller.
 *
 * @Route("societe")
 */
class SocieteController extends Controller {

    /**
     * Lists all societe entities.
     *
     * @Route("/", name="societe_index")
     * @Method("GET")
     */
    public function indexAction() {       

        $em = $this->getDoctrine()->getManager();

        $societes = $em->getRepository('MyFOSUserBundle:Societe')->findAll();

        if ($this->getUser()) {

            $arraySocie = ["user" => $this->getUser()->getId()];
            $societe = $em->getRepository('MyFOSUserBundle:Societe')->findOneBy($arraySocie);
            return $this->render('societe/index.html.twig', array(
                        'societes' => $societes,
                        'maSociete' => $societe,
            ));
        } else {
            return $this->render('societe/index.html.twig', array(
                        'societes' => $societes,
            ));
        }
        


    }

    /**
     * Creates a new societe entity.
     *
     * @Route("/new", name="societe_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $societe = new Societe();

        $form = $this->createFormBuilder($societe)
                ->add('denomination')
                ->add('presentation')
                ->add('adresse')
                ->add('siret')
                ->add('tel', TextType::class, array('label' => 'Téléphone : '))
                ->add('logo', FileType::class, array(
                    'label' => 'Votre Logo : ',
                    'data_class' => null)
                )
                ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $societe->setUser($this->getUser());
            $societe->uploadLogo();

            $em = $this->getDoctrine()->getManager();
            $em->persist($societe);
            $em->flush($societe);
           
            return $this->redirectToRoute('societe_show', array('id' => $societe->getId()));
        }

        return $this->render('societe/new.html.twig', array(
                 
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a societe entity.
     *
     * @Route("/{id}", name="societe_show")
     * @Method("GET")
     */
    public function showAction(Societe $societe) {
        $deleteForm = $this->createDeleteForm($societe);

        return $this->render('societe/show.html.twig', array(
                    'societe' => $societe,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing societe entity.
     *
     * @Route("/{id}/edit", name="societe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Societe $societe) {
        $deleteForm = $this->createDeleteForm($societe);
        $monlogo = new UploadedFile($societe->getAbsoluteLogoRoot(), $societe->getWebLogoPath());

        $editForm = $this->createFormBuilder($societe)
                ->add('denomination')
                ->add('presentation')
                ->add('adresse')
                ->add('siret')
                ->add('tel')
                ->add('logo', FileType::class, array(
                    'required' => false,
                    'empty_data' => $monlogo,
                    'data' => $monlogo,
                    'label' => 'Votre Logo : ',
                    'data_class' => null)
                )
                ->getForm()
        ;
        $editForm->handleRequest($request);


        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $societe->setUser($this->getUser());
            if ($societe->getLogo() != $monlogo) {
                $societe->uploadLogo();
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('societe_show', array('id' => $societe->getId()));
        }

        return $this->render('societe/edit.html.twig', array(
                    'societe' => $societe,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a societe entity.
     *
     * @Route("/{id}", name="societe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Societe $societe) {
        $form = $this->createDeleteForm($societe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($societe);
            $em->flush($societe);
        }

        return $this->redirectToRoute('societe_index');
    }

    /**
     * Creates a form to delete a societe entity.
     *
     * @param Societe $societe The societe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Societe $societe) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('societe_delete', array('id' => $societe->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function uploadAction() {
        // ...

        if ($form->isSubmitted() && $form->isValid()) {

            //   $someNewFilename = 

            $form['attachment']->getData()->move($dir, $someNewFilename);

            // ...
        }

        // ...
    }

    /**
     * Finds and displays a societe entity: with project published
     *
     * @Route("/{id}/projet", name="societe_projet")
     * @Method("GET")
  
    public function projetAction(Societe $societe, Request $request) {

        $em = $this->getDoctrine()->getManager();

        $id = array('societe' => $request->get('id'));

        $projets = $em->getRepository('MyFOSUserBundle:Projet')->findBy($id);

    }
       */
   
}
