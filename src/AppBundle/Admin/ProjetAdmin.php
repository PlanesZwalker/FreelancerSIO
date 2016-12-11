<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProjetAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {  
        $formMapper
            ->with('Informations Tarifaires', array('class' => 'col-md-9'))
                ->add('prix', 'number')
            ->end()

            ->with('Etapes', array('class' => 'col-md-9'))    
                ->add('etape', 'text')
             ->end()    
            ->with('Description', array('class' => 'col-md-9'))
                ->add('description', 'textarea')
            ->end()
        ;        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('prix');
        $datagridMapper->add('etape');
        $datagridMapper->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('prix');
        $listMapper->addIdentifier('etape');
        $listMapper->addIdentifier('description');

    }
}