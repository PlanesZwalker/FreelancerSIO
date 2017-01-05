<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\Testfreelancer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Testfreelancer controller.
 *
 * @Route("testfreelancer")
 */
class TestfreelancerController extends Controller
{
    /**
     * Lists all testfreelancer entities.
     *
     * @Route("/", name="testfreelancer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $testfreelancers = $em->getRepository('MyFOSUserBundle:Testfreelancer')->findAll();

        return $this->render('testfreelancer/index.html.twig', array(
            'testfreelancers' => $testfreelancers,
        ));
    }

    /**
     * Finds and displays a testfreelancer entity.
     *
     * @Route("/{id}", name="testfreelancer_show")
     * @Method("GET")
     */
    public function showAction(Testfreelancer $testfreelancer)
    {

        return $this->render('testfreelancer/show.html.twig', array(
            'testfreelancer' => $testfreelancer,
        ));
    }
}
