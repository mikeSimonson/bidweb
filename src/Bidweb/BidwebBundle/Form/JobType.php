<?php

namespace Bidweb\BidwebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Bidweb\BidwebBundle\Entity\State;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\EntityRepository;

class JobType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title')
                ->add('companyName')
                ->add('skills')
                ->add('address')
                ->add('state')
                ->add('duration')
                ->add('file','file',array('image_path' => 'webPath','label' => 'Company Logo','required'=> false))
                ->add('workingType')
                ->add('description', 'textarea')
        ;

        $builder->add('subcategory', 'entity', array(
            'class' => 'BidwebBundle:SubCategory',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                        ->where('u.category = 5')
                                ->orderBy('u.id', 'ASC');
            },
        ));
            
        $formModifier = function (FormInterface $form, State $state = null) {

            $cities = null === $state ? array() : $state->getCities();

            $form->add('city', 'entity', array(
                'class' => 'BidwebBundle:City',
                'placeholder' => '',
                'choices' => $cities,
            ));
        };
        
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifier($event->getForm(),$data->getState());
            }
        );
        
       
        
        $builder->get('state')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $state = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $state);
            }
        );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bidweb\BidwebBundle\Entity\Job'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'job';
    }

}
