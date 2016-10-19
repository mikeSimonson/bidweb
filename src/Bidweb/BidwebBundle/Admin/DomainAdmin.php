<?php
namespace Bidweb\BidwebBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



/**
 * Description of DomainAdmin
 *
 * @author HAMMAMI
 */
class DomainAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
       
        
        $formMapper
            ->add('user','entity', array('label' => 'User','class' => 'Bidweb\UserBundle\Entity\User'))    
            ->add('title','text', array('label' => 'Website Title'))
            ->add('domain','text', array('label' => 'Web site Domain'))
            ->add('price','text', array('label' => 'Price'))
            ->add('dailyVisitor','text', array('label' => 'Daily visitor'))
           ->add('slug','text', array('label' => 'Web site Slug'))
           ->add('detail','textarea', array('label' => 'Detail'))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('user')
            ->add('title')
            ->add('domain')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('slug')
            ->add('domain')
                ->add('user')
        ;
    }
}