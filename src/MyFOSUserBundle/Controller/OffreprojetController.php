<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\Offreprojet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Offreprojet controller.
 *
 * @Route("offreprojet")
 */
class OffreprojetController extends Controller
{
    /**
     * Lists all offreprojet entities.
     *
     * @Route("/", name="offreprojet_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $offreprojets = $em->getRepository('MyFOSUserBundle:Offreprojet')->findAll();

        return $this->render('offreprojet/index.html.twig', array(
            'offreprojets' => $offreprojets,
        ));
    }

    /**
     * Finds and displays a offreprojet entity.
     *
     * @Route("/{id}", name="offreprojet_show")
     * @Method("GET")
     */
    public function showAction(Offreprojet $offreprojet)
    {

        return $this->render('offreprojet/show.html.twig', array(
            'offreprojet' => $offreprojet,
        ));
    }
}
