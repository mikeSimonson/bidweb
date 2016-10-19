<?php

namespace Bidweb\BidwebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MessageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', 'text',array('label' => 'subject',
            'translation_domain' => 'messages','attr'=>array('class'=>'form-control')))
            ->add('message', 'textarea',array('label' => 'message',
            'translation_domain' => 'messages','attr'=>array('class'=>'form-control')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bidweb\BidwebBundle\Entity\Message'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bidweb_bidwebbundle_message';
    }
}
