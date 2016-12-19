<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('username', 'text');
        $formMapper->add('email', 'text');
        $formMapper->add('password', 'text');
        $formMapper->with('Roles')
                                
            ->add('roles', ChoiceType::class,[ 
                            'label' => 'Selectionnez le type de compte',
                            'attr'  => array('class' => 'myselect'),
                            'multiple'  => true,
                            'choices'   => [
                                    ' Freelancer' => 'ROLE_FREELANCER',
                                     ' Société' => 'ROLE_SOCIETE',
                                    ]
                              ])

                    ->end();

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('username');
        $datagridMapper->add('email');
        $datagridMapper->add('password');
        $datagridMapper->add('roles');

    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('username');
        $listMapper->addIdentifier('email');
        $listMapper->addIdentifier('password');
        $listMapper->addIdentifier('roles');

    }
}