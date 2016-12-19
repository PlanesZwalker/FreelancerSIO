<?php

namespace AppBundle\Admin;

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
                ->add('url_test', 'text')
             ->end()    
            ->with('resultat', array('class' => 'col-md-9'))
                ->add('resultat', 'textarea')
            ->end()
            ->with('date_passage', array('class' => 'col-md-9'))
                ->add('date_passage', 'datetime')
            ->end()
        ;        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('description');
        $datagridMapper->add('url_test');
        $datagridMapper->add('resultat');

    }
    
    
    
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('description');
        $listMapper->addIdentifier('url_test');
        $listMapper->addIdentifier('resultat');
    }

}