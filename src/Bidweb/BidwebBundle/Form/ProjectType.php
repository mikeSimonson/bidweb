<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Form;

/**
 * Description of ProjectType
 *
 * @author Walid
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Bidweb\BidwebBundle\Entity\State;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\EntityRepository;

class ProjectType extends AbstractType{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title')
                ->add('budget')
                ->add('category')
                ->add('openedPost')
                ->add('description', 'textarea')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bidweb\BidwebBundle\Entity\Project'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'project';
    }

}
