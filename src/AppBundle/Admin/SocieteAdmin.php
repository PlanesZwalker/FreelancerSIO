<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class SocieteAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {  
        $formMapper
            ->with('Siret', array('class' => 'col-md-9'))
                ->add('siret', 'text')
            ->end()

            ->with('Denomination', array('class' => 'col-md-9'))    
                ->add('denomination', 'text')
             ->end()    
         
        ;        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('siret');
        $datagridMapper->add('denomination');

    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('siret');
        $listMapper->addIdentifier('denomination');

    }
}