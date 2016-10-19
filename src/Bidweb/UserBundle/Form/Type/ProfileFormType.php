<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


/**
 * Description of ProfileFormType
 *
 * @author HAMMAMI
 */
class ProfileFormType extends AbstractType {
    //put your code here
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder->add('firstname', 'text',array('label' => 'first.name',
            'translation_domain' => 'messages'));
        $builder->add('lastname', 'text',array('label' => 'last.name',
            'translation_domain' => 'messages'));
        $builder->add('phone', 'text',array('label' => 'phone',
            'translation_domain' => 'messages'));
        $builder->add('address', 'text',array('label' => 'address',
            'translation_domain' => 'messages'))
             ->add('file', 'file', array('image_path' => 'webPathImage','required'=>false));
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
