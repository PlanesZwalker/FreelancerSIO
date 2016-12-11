<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class FreelancerAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('age', 'integer');
        $formMapper->add('urlCv', 'text');
        $formMapper->add('urlPhoto', 'text');

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('age');
        $datagridMapper->add('urlCv');
        $datagridMapper->add('urlPhoto');

    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('age');
        $listMapper->addIdentifier('urlCv');
        $listMapper->addIdentifier('urlPhoto');

    }
}