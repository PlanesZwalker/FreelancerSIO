<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\Message;
use MyFOSUserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Message controller.
 *
 * @Route("message")
 */
class MessageController extends Controller {

    /**
     * Lists all message entities.
     *
     * @Route("/", name="message_index")
     * @Method("GET")
     */
    public function indexAction(Request $request) {
        
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository('MyFOSUserBundle:Message')->findAll();
        $messages_send = null; 
        $messages_received = null;
        
        if($request->get('id_user_send')){
            $id_user_send = $request->get('id_user_send');
            $criteria_send = ['idUserFrom'=> $id_user_send];
            $messages_send = $em->getRepository('MyFOSUserBundle:Message')->findBy($criteria_send);
        }
      
        if($request->get('id_user_received')){
            $id_user_received = $request->get('id_user_received');
            $criteria_received = ['idUserFor'=> $id_user_received];
            $messages_received = $em->getRepository('MyFOSUserBundle:Message')->findBy($criteria_received);
        }

        return $this->render('message/index.html.twig', array(
                'messages' => $messages,
                'messages_send' => $messages_send,
                'messages_received' => $messages_received
        ));
    }

    /**
     * Creates a new message entity.
     *
     * @Route("/new", name="message_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        
        $message = new Message();
       
        $em = $this->getDoctrine()->getManager();
        
        // on recupere l'id de l'utilisateur courant et du destinataire du message
        $id_user_from = $this->getUser()->getId();
        $id_user_for = $request->get('id_user_for');

        
        // on retrouve les informations de cet utilisateur 
        $arrayUserFor = ['id' => $id_user_for];
        $user_for = $em->getRepository('MyFOSUserBundle:User')->findOneBy($arrayUserFor);
        
        $arrayUserFrom = ['id' => $id_user_from];
        $user_from = $em->getRepository('MyFOSUserBundle:User')->findOneBy($arrayUserFrom);

        $arrayUserId = ['user' => $user_for];
        
        $societe_for = $em->getRepository('MyFOSUserBundle:Societe')->findOneBy($arrayUserId);
        $freelancer_for = $em->getRepository('MyFOSUserBundle:Freelancer')->findOneBy($arrayUserId);

        $form = $this->createFormBuilder($message)
                ->add('type', ChoiceType::class, [
                    'label' => 'Selectionnez le type de message',
                    'multiple' => false,
                    'choices' => [
                        ' Catégorie projet ' => 'projet',
                        ' Catégorie offre' => 'offre',
                        ' Catégorie Réponse' => 'réponse',
                        ' Message privé' => 'privé',
                    ]
                ])
                ->add('sujet')
                ->add('contenu', CKEditorType::class, array(
                    'input_sync' => true,
                    'config' => array(
                        'uiColor' => '#020F58',
                    ),
                    'label' => 'Contenu de votre message : ',
                ))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //$date = date('Y-m-d H:i:s');
            $message->setDate(new \DateTime());
            
            $message->setIdUserFor($user_for);            
            $message->setIdUserFrom($user_from);

            $em->persist($message);
            $em->flush($message);

            return $this->redirectToRoute('message_show', array('id' => $message->getIdMessage()));
        }

        return $this->render('message/new.html.twig', array(
                    'message' => $message,
                    'societe' => $societe_for,
                    'freelancer' => $freelancer_for,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a message entity.
     *
     * @Route("/{id}", name="message_show")
     * @Method("GET")
     */
    public function showAction(Message $message) {
        $deleteForm = $this->createDeleteForm($message);

        return $this->render('message/show.html.twig', array(
                    'message' => $message,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing message entity.
     *
     * @Route("/{id}/edit", name="message_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Message $message) {
        $deleteForm = $this->createDeleteForm($message);
        $editForm = $this->createForm('MyFOSUserBundle\Form\MessageType', $message);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('message_edit', array('id' => $message->getIdMessage()));
        }

        return $this->render('message/edit.html.twig', array(
                    'message' => $message,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a message entity.
     *
     * @Route("/{id}", name="message_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Message $message) {
        $form = $this->createDeleteForm($message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($message);
            $em->flush($message);
        }

        return $this->redirectToRoute('message_index');
    }

    /**
     * Creates a form to delete a message entity.
     *
     * @param Message $message The message entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Message $message) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('message_delete', array('id' => $message->getIdMessage())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
