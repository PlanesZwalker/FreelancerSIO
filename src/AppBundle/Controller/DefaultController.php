<?php

namespace AppBundle\Controller;
use Silex\Application;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * 
     */
    public function indexAction(Request $request)
    {
        $test = array('8','test ok');
        $name= "Admin";
        
        // replace this example code with whatever you need
        return $this->render('freelance/index.html.twig', array(
            'test'=>$test,
            'name'=>$name
        ));
    }
    /**
     * @Route("/logout", name="logout")
     * 
     */
    public function logoutAction(Request $request)
    {
        return $this->render('front/index.html.twig');
    }
    
    /**
     * @Route("/front", name="front")
     * 
     */
    public function frontAction(Request $request)
    {
         return $this->render('/front/index.html.twig');
    }
    
     /**
     * @Route("/test", name="test")
     */
    public function testAction(Request $request)
    {
            $name='test';
        
         return $this->render('listfreelancer.html.twig', array(
            'name' => $name,
        )); 
   
    }
     /**
     * @Route("/listfreelancer", name="listfreelancer")
     */
    public function listFreelancerAction(Request $request)
    {
            $name='test';
        
         return $this->render('listfreelancer.html.twig', array(
            'name' => $name,
        )); 
   
    }
     /**
     * @Route("/listprojet", name="listprojet")
     */
    public function listProjetAction(Request $request)
    {
            $name='test';
        
         return $this->render('listprojet.html.twig', array(
            'name' => $name,
        )); 
   
    }
    
    /**
     * @Route("/addprojet", name="addprojet")
     */
    public function addProjetAction(Request $request)
    {
        
         return $this->render('societe/addprojet.html.twig');
   
    }
    
    /**
     * @Route("/editprofil", name="editprofil")
     */
    public function editProfilAction(Request $request)
    {
        
         return $this->render('freelance/editprofil.html.twig');
   
    }


}
