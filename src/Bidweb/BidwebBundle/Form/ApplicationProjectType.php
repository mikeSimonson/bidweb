<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Form;

/**
 * Description of ApplicationProjectType
 *
 * @author Walid
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Bidweb\UserBundle\Entity\User;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\EntityRepository;



class ApplicationProjectType extends AbstractType{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('budget','text')
                ->add('message','textarea');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bidweb\BidwebBundle\Entity\ApplicationProject'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'applicationproject';
    }
}
