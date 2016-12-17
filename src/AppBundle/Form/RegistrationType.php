<?php
// src/AppBundle/Form/RegistrationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RegistrationType extends AbstractType
{
  
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
                  
            $builder->add('roles', ChoiceType::class,[ 
                            'label' => 'Selectionnez le type de compte',
                            'attr'  => array('class' => 'myselect'),
                            'multiple'  => true,
                            'choices'   => [
                                    'ROLE_FRELANCER' => 'Freelancer',
                                    'ROLE_SOCIETE' => 'Societe',
                                ]

                        ]);
    }
    

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}