<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Description of ProfileAdmin
 *
 * @author HAMMAMI
 */
class ProfileAdmin {

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper) {


        $formMapper
                ->add('user', 'entity', array('label' => 'User', 'class' => 'Bidweb\UserBundle\Entity\User'))
                ->add('title', 'text', array('label' => 'Title'))
                ->add('taxonomy', 'text', array('label' => 'Taxonomy'))
                ->add('price', 'text', array('label' => 'Price'))
                ->add('demo', 'text', array('label' => 'Demo'))
                ->add('quantity', 'text', array('label' => 'Quantity'))
                ->add('slug', 'text', array('label' => 'Web site Slug'))
                ->add('detail', 'textarea', array('label' => 'Detail'))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('user')
                ->add('title')
                ->add('taxonomy')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('title')
                ->add('slug')
                ->add('taxonomy')
                ->add('user')
        ;
    }

}