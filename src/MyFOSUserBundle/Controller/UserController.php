<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\User;
use MyFOSUserBundle\Entity\Freelancer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckBoxType;

use FOS\UserBundle\Util\LegacyFormHelper;
/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('MyFOSUserBundle:User')->findAll();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
         
       $user = new User();
        $form = $this->createFormBuilder($user)
                   
                    ->add('username')
                    ->add('name')
                    ->add('firstname')
                    ->add('email')
                    ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
                      'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
                      'options' => array('translation_domain' => 'MyFOSUserBundle'),
                      'first_options' => array('label' => 'form.password'),
                      'second_options' => array('label' => 'form.password_confirmation'),
                      'invalid_message' => 'fos_user.password.mismatch',
                  ))     
                
                ->getForm();
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
           $user->setEnabled(true);
           $role = serialize("ROLE_SUPER_ADMIN");
           $user->setRoles(array ($role=>"ROLE_SUPER_ADMIN"));
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush($user);

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }

        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
      
      
    
      
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
          
        $em = $this->getDoctrine()->getManager();
        $id =$user->getId();
        $criteria=  array ('user' => $id);
        $freelancer = $em->getRepository('MyFOSUserBundle:Freelancer')->findOneBy($criteria);
        $societe = $em->getRepository('MyFOSUserBundle:Societe')->findOneBy($criteria);
        return $this->render('user/show.html.twig', array(
            'user' => $user,
            'freelancer' => $freelancer,
            'societe' => $societe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $em = $this->getDoctrine()->getManager();
        
        $id = $user->getId();
        $criteria=  array ('user' => $id);
        $freelancer = $em->getRepository('MyFOSUserBundle:Freelancer')->findOneBy($criteria);
       
        $freelancers = $em->getRepository('MyFOSUserBundle:Freelancer')->findAll();
                
        $role=$user->getRoles();
        if($role[0]=="ROLE_SUPER_ADMIN"){
             $editForm = $this->createFormBuilder($user)
             ->add('roles', ChoiceType::class,[ 
                                'label' => 'Selectionnez le type de compte',                              
                                'multiple'  => true,
                                'choices'   => [
                                    ' Freelancer' => 'ROLE_FREELANCER',
                                    ' Admin' => 'ROLE_SUPER_ADMIN',
                                    ' Société' => 'ROLE_SOCIETE',
                                ]
                          ]) 
                ->add('username')
                ->add('name')
                ->add('firstname')
                ->add('email')
            ->getForm();                            
        }else{
            $editForm = $this->createFormBuilder($user)
                ->add('roles', ChoiceType::class,[ 
                                    'label' => 'Selectionnez le type de compte',                              
                                   // 'expanded' => true,
                                    'multiple' => true,
                                    'choices'   => [
                                        'Freelancer' => 'ROLE_FREELANCER',
                                        'Société' => 'ROLE_SOCIETE',
                                    ],
                                    'preferred_choices' => [
                                       
                                        ' Société' => 'ROLE_SOCIETE',
                                    ]
                                 
                              ]) 
                    ->add('username')
                    ->add('name')
                    ->add('firstname')
                    ->add('email')
                ->getForm();
        }
    
                
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'freelancers' =>$freelancers,
            'freelancer' =>$freelancer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'id'=>$id,
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush($user);
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
