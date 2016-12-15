<?php

namespace MyFOSUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyFOSUserBundle:Default:index.html.twig');
    }
}
