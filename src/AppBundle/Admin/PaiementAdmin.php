<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PaiementAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {  
        $formMapper
            ->with('Etat', array('class' => 'col-md-9'))
                ->add('etat', 'number')
            ->end()

        ;        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('etat');

    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('etat');

    }
}