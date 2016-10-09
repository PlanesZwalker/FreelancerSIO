<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('freelance/index.html');
    }
    
     /**
     * @Route("/test", name="test")
     */
    public function testAction(Request $request, Application $app)
    {
     $app->get('/hello/{name}', function ($name) use ($app) {
        return $app['twig']->render('default/index.html.twig', array(
            'name' => $name,
        )); 
    });
    }

}
