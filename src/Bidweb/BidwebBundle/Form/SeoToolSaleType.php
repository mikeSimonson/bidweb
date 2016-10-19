<?php

namespace Bidweb\BidwebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SeoToolSaleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('taxonomy')
            ->add('price')
            ->add('detail','textarea')
            ->add('demo')
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bidweb\BidwebBundle\Entity\SeoToolSale'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bidweb_bidwebbundle_seotoolsale';
    }
}
