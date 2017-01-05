<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MyFOSUserBundle\Form;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationType extends AbstractType
{


     public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array('label' => 'form.email', 'translation_domain' => 'MyFOSUserBundle'))
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'MyFOSUserBundle'))
            ->add('name')
            ->add('firstname')
            ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
                'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
                'options' => array('translation_domain' => 'MyFOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))                       
            ->add('roles', ChoiceType::class,[ 
                                'label' => 'Selectionnez le type de compte',
                                'attr'  => array('class' => 'myselect'),
                                'multiple'  => true,
                                'choices'   => [
                                    ' Freelancer' => 'ROLE_FREELANCER',
                                    ' Société' => 'ROLE_SOCIETE',
                                ]

                          ])    
              
                  ;
                            
    }
    
    
     public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 're_fos_user_registration';
    }
}
