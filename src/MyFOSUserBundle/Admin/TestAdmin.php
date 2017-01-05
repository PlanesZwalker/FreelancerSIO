<?php

namespace MyFOSUserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TestAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
         $formMapper
            ->with('Description', array('class' => 'col-md-9'))
                ->add('description', 'text')
            ->end()

            ->with('url_test', array('class' => 'col-md-9'))    
                ->add('urlTest', 'text')
             ->end()    
            ->with('resultat', array('class' => 'col-md-9'))
                ->add('resultat', 'textarea')
            ->end()
            ->with('date_passage', array('class' => 'col-md-9'))
                ->add('datePassage', 'datetime')
            ->end()
        ;        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('description');
        $datagridMapper->add('urlTest');
        $datagridMapper->add('resultat');

    }
    
    
    
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('description');
        $listMapper->addIdentifier('urlTest');
        $listMapper->addIdentifier('resultat');
    }

}