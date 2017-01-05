<?php
namespace MyFOSUserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CahierdesChargesAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('tarif', 'number');
        $formMapper->add('delai', 'text');

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('tarif');
        $datagridMapper->add('delai');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('tarif');
        $listMapper->addIdentifier('delai');

    }
}