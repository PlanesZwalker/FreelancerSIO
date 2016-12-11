<?php

namespace AppBundle\Controller;

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
                        'uiColor' => '#ffffff',
                    ),
                    'label' => 'Editeur de texte',  
                  ))           
                ->getForm();

    
        return $this->render('/front/index.html.twig', array(
            'formRecherche' => $formRecherche->createView(),
            'form' => $form->createView(),
        ));
    }
    
  
     /**
     * @Route("/listfreelancer", name="listfreelancer")
     */
    public function listFreelancerAction(Request $request)
    {
            $name='test';
        
         return $this->render('/listfreelancer.html.twig', array(
            'name' => $name,
        )); 
   
    }
     /**
     * @Route("/listprojet", name="listprojet")
     */
    public function listProjetAction(Request $request)
    {
            $name='test';
        
         return $this->render('/listprojet.html.twig', array(
            'name' => $name,
        )); 
   
    }
    
    /**
     * @Route("/editprofil", name="editprofil")
     */
    public function editProfilAction(Request $request)
    {
       $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('Espace privé !');
        }

        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView()
        ));
   
    }
    


}
