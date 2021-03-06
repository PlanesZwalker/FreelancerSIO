<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\Messagefreelancer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Messagefreelancer controller.
 *
 * @Route("messagefreelancer")
 */
class MessagefreelancerController extends Controller
{
    /**
     * Lists all messagefreelancer entities.
     *
     * @Route("/", name="messagefreelancer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $messagefreelancers = $em->getRepository('MyFOSUserBundle:Messagefreelancer')->findAll();

        return $this->render('messagefreelancer/index.html.twig', array(
            'messagefreelancers' => $messagefreelancers,
        ));
    }

    /**
     * Finds and displays a messagefreelancer entity.
     *
     * @Route("/{id}", name="messagefreelancer_show")
     * @Method("GET")
     */
    public function showAction(Messagefreelancer $messagefreelancer)
    {

        return $this->render('messagefreelancer/show.html.twig', array(
            'messagefreelancer' => $messagefreelancer,
        ));
    }
}
