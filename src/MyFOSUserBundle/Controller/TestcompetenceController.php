<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\Testcompetence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Testcompetence controller.
 *
 * @Route("testcompetence")
 */
class TestcompetenceController extends Controller {

    /**
     * Lists all testcompetence entities.
     *
     * @Route("/", name="testcompetence_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $testcompetences = $em->getRepository('MyFOSUserBundle:Testcompetence')->findAll();

        return $this->render('testcompetence/index.html.twig', array(
                    'testcompetences' => $testcompetences,
        ));
    }

    /**
     * Finds and displays a testcompetence entity.
     *
     * @Route("/{id}", name="testcompetence_show")
     * @Method("GET")
     */
    public function showAction(Testcompetence $testcompetence) {

        return $this->render('testcompetence/show.html.twig', array(
                    'testcompetence' => $testcompetence,
        ));
    }

}
