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
 * Description of WebsiteAdmin
 *
 * @author HAMMAMI
 */
class WebsiteAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        // get the current Image instance
        $image = $this->getSubject();

        // use $fileFieldOptions so we can add other options to the field
        $fileFieldOptions = array('required' => false);
        if ($image && ($webPath = $image->getWebPathLogo())) {
            // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request')->getBasePath().'/'.$webPath;

            // add a 'help' option containing the preview's img tag
            $fileFieldOptions['help'] = '<img src="'.$fullPath.'" class="admin-preview" width="100" height="100"/>';
        }
        
         // use $fileFieldOptions so we can add other options to the field
        $fileFieldThOptions = array('required' => false);
        if ($image && ($webPath = $image->getWebPathSiteThumbnail())) {
            // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request')->getBasePath().'/'.$webPath;

            // add a 'help' option containing the preview's img tag
            $fileFieldThOptions['help'] = '<img src="'.$fullPath.'" class="admin-preview" width="100" height="100"/>';
        }
        
        
        $formMapper
            ->add('user','entity', array('label' => 'User','class' => 'Bidweb\UserBundle\Entity\User'))    
            ->add('siteName','text', array('label' => 'Site Name'))
            ->add('title','text', array('label' => 'Website Title'))
            ->add('domain','text', array('label' => 'Web site Domain'))
           ->add('slug','text', array('label' => 'Web site Slug'))
          
            
            ->add('price','text', array('label' => 'Price'))
          
          
            ->add('serverType','entity', array('label' => 'Sever Type','class' => 'Bidweb\BidwebBundle\Entity\ServerType'))
            ->add('buildType','entity', array('label' => 'Sever Type','class' => 'Bidweb\BidwebBundle\Entity\BuildType'))
            ->add('file', 'file',$fileFieldOptions)
            ->add('file2', 'file', $fileFieldThOptions)
                ->add('detail','textarea', array('label' => 'Detail'))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('user')
            ->add('title')
            ->add('siteName')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('slug')
            ->add('siteName')
                ->add('user')
        ;
    }
}