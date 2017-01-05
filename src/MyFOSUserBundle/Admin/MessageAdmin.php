<?php

namespace MyFOSUserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class MessageAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
         $formMapper
            ->with('Type de message', array('class' => 'col-md-9'))
                ->add('type', 'text')
            ->end()

            ->with('Sujet', array('class' => 'col-md-9'))    
                ->add('sujet', 'text')
             ->end()    
            ->with('Contenu', array('class' => 'col-md-9'))
                ->add('contenu', 'textarea')
            ->end()
        ;        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('type');
        $datagridMapper->add('sujet');
        $datagridMapper->add('contenu');

    }
    
    
    
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('type');
        $listMapper->addIdentifier('sujet');
        $listMapper->addIdentifier('contenu');
    }

}