<?php

namespace MyFOSUserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class BlogPostAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Content', array('class' => 'col-md-9'))
                ->add('title', 'text')
                ->add('body', 'textarea')
            ->end()
            ->with('Category', array('class' => 'col-md-9'))
                ->add('category', 'entity', array(
                    'class' => 'AppBundle\Entity\Category',
                    'choice_label' => 'name',
                ))
            ->end()
            ->with('Metadata', array('class' => 'col-md-9'))
                ->add('draft')
                ->add('createdAt', 'datetime')
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
        $datagridMapper->add('body');
        $datagridMapper->add('draft');
      //  $datagridMapper->add('category');

    }
    
    
    
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('title');
        $listMapper->add('body');
        $listMapper->add('draft');
     //   $listMapper->add('category');
    }
  
    
}