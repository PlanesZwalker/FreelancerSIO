<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class OffreAdmin extends Admin
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
            ->with('Proposition Commerciale', array('class' => 'col-md-9'))
                ->add('propCommerciale', 'text')
            ->end()
            ->with('Particularités', array('class' => 'col-md-9'))
                ->add('particularite', 'text')
            ->end()
        ;        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('tarif');
        $datagridMapper->add('delai');
        $datagridMapper->add('propCommerciale');
        $datagridMapper->add('particularite');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('tarif');
        $listMapper->addIdentifier('delai');
        $listMapper->addIdentifier('propCommerciale');
        $listMapper->addIdentifier('particularite');

    }
}