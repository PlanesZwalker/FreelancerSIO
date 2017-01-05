<?php

namespace MyFOSUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class FreelancerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('description')
                ->add('cv', FileType::class, array(
                    'label' => 'Votre Cv : ',
                    
                    'data_class' => null))
                ->add('photo', FileType::class, array(
                    'label' => 'Votre photo : ',
                    
                    'data_class' => null))
                ->add('pseudo')
                ->add('nationnalite')
                ->add('age')
                ->add('user')
              
             
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyFOSUserBundle\Entity\Freelancer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myfosuserbundle_freelancer';
    }


}
