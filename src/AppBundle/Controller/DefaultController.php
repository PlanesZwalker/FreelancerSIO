<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;


$formFactory = Forms::createFormFactory();

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
   
        $formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new HttpFoundationExtension())
            ->getFormFactory();
        
        $formFactoryGET = $formFactory->createBuilder(FormType::class, null, array(
            'action' => '/search',
            'method' => 'GET',
        ));
        
         $formRecherche = $this->createFormBuilder() 
                 
                 ->add('Recherche', ChoiceType::class, array(
                    'choices' => array(
                        'Projets en ligne' => 'Projetenligne',
                        'Profils des Freelancers' => 'Profilfreelancer',
                        'Projets achevés' => 'Projetacheves',
                        'Test de compétences en cours' => 'Testdecompetences',
                        'Tous les tests de compétences' => 'Touslestestsdecompetences',
                    ),
                    'required'    => false,
                    'placeholder' => 'Sélectionner votre recherche',
                    'empty_data'  => null
                ))
                 
                ->add('MotsCles', TextType::class, array(
                    'constraints' => new NotBlank(),
                    'label' => 'Recherche par mots-cles',
                ))
                 
              
                ->getForm();

         
         $form =  $this->createFormBuilder() 
                 ->add('Editeur', CKEditorType::class, array(
                    'config' => array(
                        'uiColor' => '#ffffff',
                    )   ))           
                 ->getForm();

       $formRecherche->handleRequest($request);
        
  
            if ($formRecherche->isValid()) {
                $data = $formRecherche->getData();            
            }
   
        return $this->render('/front/index.html.twig', array(
            'formRecherche' => $formRecherche->createView(),
            'form' => $form->createView(),
        ));
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
