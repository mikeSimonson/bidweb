<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\UserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Description of UserAdmin
 *
 * @author walid
 */
class UserAdmin extends Admin{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper) {
        $image = $this->getSubject();

        // use $fileFieldOptions so we can add other options to the field
        $fileFieldOptions = array('required' => false);
        if ($image && ($webPath = $image->getWebPathImage())) {
            // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request')->getBasePath() . '/' . $webPath;

            // add a 'help' option containing the preview's img tag
            $fileFieldOptions['help'] = '<img src="' . $fullPath . '" class="admin-preview" width="100" height="100"/>';
        }

        $formMapper
               
                ->add('username', 'text', array('label' => 'User Name'))
                ->add('email', 'text', array('label' => 'Email'))
                ->add('firstName', 'text', array('label' => 'First name'))
                ->add('lastName', 'text', array('label' => 'Last name'))
                ->add('address', 'text', array('label' => 'Address'))
                ->add('phone', 'text', array('label' => 'Phone'))
                ->add('file', 'file', $fileFieldOptions)
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('username')
                ->add('email')
                ->add('firstName')
                ->add('lastName')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('username')
                ->add('email')
                ->add('firstName')
                ->add('lastName')
        ;
    }
}
