<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ContratAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {  
        $formMapper
            ->with('Informations Tarifaires', array('class' => 'col-md-9'))
                ->add('tarif', 'number')
            ->end()

            ->with('Délais', array('class' => 'col-md-9'))    
                ->add('delai', 'text')
             ->end()    
            ->with('Date de la signature du contrat', array('class' => 'col-md-9'))
                ->add('dateSign', 'datetime')
            ->end()
        ;        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('tarif');
        $datagridMapper->add('delai');
        $datagridMapper->add('dateSign');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('tarif');
        $listMapper->addIdentifier('delai');

    }
}