<?php

namespace MyFOSUserBundle\Controller;
   
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

//use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
//use Symfony\Component\Validator\Constraints\Type;
//use Symfony\Component\Form\Extension\Core\Type\HiddenType;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
//use Symfony\Component\Form\Extension\Core\Type\FormType;
//use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
//use FOS\UserBundle\Model\UserManagerInterface;
//use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
//use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
 
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

//$formFactory = Forms::createFormFactory();

class DefaultController extends Controller
{

    /**
     * @Route("/", name="front")
     * 
     */
    public function indexAction(Request $request)
    {
       
 
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
                    'data' => 'Recherche par mots-cles', 
  
                ))

                ->add('NombreDeResultat', RangeType::class, array(
                    'attr' => array(
                        'min' => 5,
                        'max' => 50,
                       // 'value' => '25' Meme resultat qu'avec data
                           
                    ),
                    'data' => '25',
     
                   
                ))
                ->getForm();
         
            $form =  $this->createFormBuilder() 
                 ->add('Editeur', CKEditorType::class, array(
                    'config' => array(
                        'uiColor' => '#020F58',
                    ),
                    'label' => 'Editeur de texte',  
                  ))           
                ->getForm();

    
        return $this->render('/front/index.html.twig', array(
            'formRecherche' => $formRecherche->createView(),
            'form' => $form->createView(),
         
        ));
    }

    public function mytbb(){
        
        $societe = new SocieteController();
        $freelancer = new FreelancerController();
     
        $em = $this->getDoctrine()->getManager();

        $maSociete=["user"=>$this->getUser()];
        $monFreelancer=["user"=>$this->getUser()];
        
        $societe = $em->getRepository("MyFOSUserBundle:Societe")->findOneBy($maSociete);
        $freelancer = $em->getRepository("MyFOSUserBundle:Freelancer")->findOneBy($monFreelancer);
        
        return $this->render('nav.html.twig', array(

            'societe' => $societe,
            'freelancer' => $freelancer
        ));
    }
    
    public function sendFileAction($file){
        
        $file_to_send = "Ressources/public/file/Symfony_book_3_0.pdf";
        $response = new BinaryFileResponse($file_to_send);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT,".$file");
        return $response;
    }
    
    
    public function serviceAction(){
        return $this->render('/service.html.twig');
    }
    
 
  
    
    /**
     * @Route("/logout", name="logout")
     * 
     */
    public function logoutAction(Request $request)
    {
            return $this->render('front/index.html.twig'); 
    }

}
