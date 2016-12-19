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
                
            ->with('Presentatino', array('class' => 'col-md-9'))    
                ->add('presentation', 'text')
             ->end()  
                
            ->with('Logo', array('class' => 'col-md-9'))    
                ->add('logo', 'text')
             ->end()    
         
        ;        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('siret');
        $datagridMapper->add('denomination');
        $datagridMapper->add('presentation');
        $datagridMapper->add('logo');

    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('siret');
        $listMapper->addIdentifier('denomination');
        $listMapper->addIdentifier('presentation');
        $listMapper->addIdentifier('logo');

    }
}