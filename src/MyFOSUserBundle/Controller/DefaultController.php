<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\Freelancer;
use MyFOSUserBundle\Entity\Societe;
use MyFOSUserBundle\Controller\MessageController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
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
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use \Swift_SmtpTransport,
    \Swift_Mailer,
    \Swift_Message;
//$formFactory = Forms::createFormFactory();
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use \Symfony\Component\Form\Extension\Core\Type\EmailType;

class DefaultController extends Controller {

    /**
     * @Route("/", name="front")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request) {

        $session = new Session();
        $session->clear();

        if ($request->get('etat') == "EmailEnvoye") {
            
            try{
                if ($this->emailAction($request)) 
                {
                    $session->getFlashBag()->add('success', 'Message bien envoyé ! Un membre du support vous répondra bientôt. ');
                } 
            } 
            catch (Exception $ex)
            {
                $session->getFlashBag()->add('error', 'Problème l\'email n\'a pas été envoyé !');
            }    
        }
        
             /*  Mis en session du profil de l'utilisateur s'il exite
                 */
         if($this->getUser()){
             
            $em = $this->getDoctrine()->getManager();
            $id_user= $this->getUser();
            $criteria=["user"=> $id_user];
            $role = $this->getUser()->getRoles();
        
            if($role[0]=="ROLE_FREELANCER"){  
            
                $freelancer = $em->getRepository('MyFOSUserBundle:Freelancer')->findOneBy($criteria);
           
                $session->set('freelancer', $freelancer);
            }
            
            if($role[0]=="ROLE_SOCIETE"){
                
                $societe = $em->getRepository('MyFOSUserBundle:Societe')->findOneBy($criteria);
                
                $session->set('societe', $societe);
            }
         }  

        return $this->render('/front/index.html.twig', array(
       
        ));
    }



    public function sendFileAction($file) {

        $file_to_send = "Ressources/public/file/Symfony_book_3_0.pdf";
        $response = new BinaryFileResponse($file_to_send);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, ".$file");
        return $response;
    }

	
	public function docAction() {
        return $this->render('/documentation.html.twig');
    }

	
	public function codeAction() {
        return $this->render('/code.html.twig');
    }


    public function serviceAction() {
        return $this->render('/service.html.twig');
    }
    /**
     * @Route("/logout", name="logout")
     * 
     */
    public function logoutAction(Request $request) {
        return $this->render('front/index.html.twig');
    }

    public function emailAction(Request $request) {
        //création d'un objet transport
        $transport = \Swift_SmtpTransport::newInstance('smtp.1und1.de', 587)
                ->setUsername('freedemat@websock.fr')
                ->setPassword('freedemat@');
        //création d'un objet mailer
        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance();
        $name = $request->get('name');
        $email = $request->get('email');
        $objet = $request->get('objet');
        $body = $request->get('body');

        $message->setSubject('FreeDematContact : ' . $objet);
        $message->setFrom('freedemat@websock.fr');
        $message->setTo('contact@cohmbox.fr');
        $message->setBody('Nouveau message de ' . $name . ' :  ' . $email . ' => ' . $body);

        //envoi du message
        if ($mailer->send($message)) {
            return true;
        } else {
            return false;
        }
    }

    
        /**
     * @Route("/tableaudebordSociete", name="tableaudebordSociete")
     * @Method({"GET", "POST"})
   
    public function tableaudebordSocieteAction(Request $request) {
        $societe = new SocieteController();

        $em = $this->getDoctrine()->getManager();

        $maSociete = ["user" => $this->getUser()];

        $societe = $em->getRepository("MyFOSUserBundle:Societe")->findOneBy($maSociete);


        return $this->render('societe/tableaudebordSociete.html.twig', array(
                    'societe' => $societe
        ));
    }
  */
    /**
     * @Route("/tableaudebordFreelancer", name="tableaudebordFreelancer")
     * @Method({"GET", "POST"})
    
    public function tableaudebordFreelancerAction(Request $request) {
        $freelancer = new FreelancerController();

        $em = $this->getDoctrine()->getManager();

        $monFreelancer = ["user" => $this->getUser()];

        $freelancer = $em->getRepository("MyFOSUserBundle:Freelancer")->findOneBy($monFreelancer);

        return $this->render('freelancer/tableaudebordFreelancer.html.twig', array(
                    'freelancer' => $freelancer
        ));
    } 
     */
}
