<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\Messagesociete;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Messagesociete controller.
 *
 * @Route("messagesociete")
 */
class MessagesocieteController extends Controller
{
    /**
     * Lists all messagesociete entities.
     *
     * @Route("/", name="messagesociete_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $messagesocietes = $em->getRepository('MyFOSUserBundle:Messagesociete')->findAll();

        return $this->render('messagesociete/index.html.twig', array(
            'messagesocietes' => $messagesocietes,
        ));
    }

    /**
     * Finds and displays a messagesociete entity.
     *
     * @Route("/{id}", name="messagesociete_show")
     * @Method("GET")
     */
    public function showAction(Messagesociete $messagesociete)
    {

        return $this->render('messagesociete/show.html.twig', array(
            'messagesociete' => $messagesociete,
        ));
    }
}
