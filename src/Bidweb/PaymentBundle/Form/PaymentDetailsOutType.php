<?php

namespace Bidweb\PaymentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class PaymentDetailsOutType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('currencyCode','text',array('attr'=>array('class'=>'form-control')))
            ->add('totalAmount','text',array('attr'=>array('class'=>'form-control')))
                ->add('clientEmail','email',array('attr'=>array('class'=>'form-control')))
                ->add('gateway_name', 'choice', array('attr'=>array('class'=>'form-control'),
                'choices' => array(
                    'paypal_express_checkou' => 'Paypal ExpressCheckout',
//                    'paypal_pro_checkout' => 'Paypal ProCheckout',
//                    'stripe_js' => 'Stripe.Js',
//                    'stripe_checkout' => 'Stripe Checkout',
//                    'authorize_net' => 'Authorize.Net AIM',
//                    'be2bill' => 'Be2bill',
//                    'be2bill_offsite' => 'Be2bill Offsite',
//                    'payex' => 'Payex',
//                    'redsys' => 'Redsys',
//                    'offline' => 'Offline',
//                    'stripe_via_omnipay' => 'Stripe (Omnipay)',
//                    'paypal_express_checkout_via_omnipay' => 'Paypal ExpressCheckout (Omnipay)',
                ),
                'mapped' => false,
                'constraints' => array(new NotBlank())
            ))
            ->add('description','textarea',array('attr'=>array('class'=>'form-control')))
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bidweb\PaymentBundle\Entity\PaymentDetails'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bidweb_paymentbundle_paymentdetails';
    }
}
