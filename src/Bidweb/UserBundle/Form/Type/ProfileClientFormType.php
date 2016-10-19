<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\UserBundle\Form\Type;

/**
 * Description of ProfileClientFormType
 *
 * @author Walid
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileClientFormType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder->add('companyName', 'text',array('label' => 'company.name',
            'translation_domain' => 'messages','required'=>false));
        
        $builder->add('city', 'text',array('label' => 'city',
            'translation_domain' => 'messages','required'=>false));
        
        $builder->add('state', 'text',array('label' => 'state',
            'translation_domain' => 'messages','required'=>false));
        
        $builder->add('country', 'text',array('label' => 'country',
            'translation_domain' => 'messages','required'=>false));
        
        $builder->add('zipCode', 'text',array('label' => 'zip.code',
            'translation_domain' => 'messages','required'=>false));
        
        $builder->add('address', 'text',array('label' => 'address',
            'translation_domain' => 'messages','required'=>false));
        
        
        
        
        $builder->add('phone', 'text',array('label' => 'phone',
            'translation_domain' => 'messages','required'=>false));
        
        $builder->add('webSite', 'text',array('label' => 'web.site',
            'translation_domain' => 'messages','required'=>false));
        
        $builder->add('paypalEmail', 'text',array('label' => 'paypal.email',
            'translation_domain' => 'messages','required'=>false));
        
        $builder->add('file', 'file', array('image_path' => 'webPathImage','required'=>false));
    }

    public function getParent()
    {
        return 'fos_user_profile';
    }

    public function getName()
    {
        return 'bidweb_user_profile';
    }
}
