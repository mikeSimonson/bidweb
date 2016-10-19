<?php

namespace Bidweb\BidwebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WebsiteSaleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('siteName')
            ->add('title')
            ->add('domain')
          
          
            ->add('detail','textarea')
            ->add('price')
          
          
            ->add('serverType')
            ->add('buildType')
            ->add('file', 'file', array('image_path' => 'webPathLogo','required'=>false))
            ->add('file2', 'file', array('image_path' => 'webPathSiteThumbnail','required'=>false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bidweb\BidwebBundle\Entity\WebsiteSale'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bidweb_bidwebbundle_websitesale';
    }
}
