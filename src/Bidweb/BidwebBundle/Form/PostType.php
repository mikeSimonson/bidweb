<?php

namespace Bidweb\BidwebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Bidweb\BidwebBundle\Entity\Category;
use Bidweb\BidwebBundle\Entity\State;
use Symfony\Component\Form\FormInterface;

class PostType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('title')
                ->add('file', 'file', array('image_path' => 'webPath1','required'=>false))
                ->add('file2', 'file', array('image_path' => 'webPath2','required'=>false))
                ->add('file3', 'file', array('image_path' => 'webPath3','required'=>false))
                ->add('file4', 'file', array('image_path' => 'webPath4','required'=>false))
                ->add('file5', 'file', array('image_path' => 'webPath5','required'=>false))
               
                ->add('website')
                ->add('address')
                ->add('price');



        $builder
                ->add('category', 'entity', array(
                    'class' => 'BidwebBundle:Category',
                    'placeholder' => '',
                ))
        ;

        $builder
                ->add('state', 'entity', array(
                    'class' => 'BidwebBundle:State',
                    'placeholder' => '',
                ))
        ;

        $builder->add('description');

        $formModifier = function (FormInterface $form, Category $category = null, State $state = null) {
            $subcategories = null === $category ? array() : $category->getSubcategories();

            $form->add('subcategory', 'entity', array(
                'class' => 'BidwebBundle:SubCategory',
                'placeholder' => '',
                'choices' => $subcategories,
            ));

            $cities = null === $state ? array() : $state->getCities();

            $form->add('city', 'entity', array(
                'class' => 'BidwebBundle:City',
                'placeholder' => '',
                'choices' => $cities,
            ));
        };

        $formModifierCat = function (FormInterface $form, Category $category = null) {
            $subcategories = null === $category ? array() : $category->getSubcategories();

            $form->add('subcategory', 'entity', array(
                'class' => 'BidwebBundle:SubCategory',
                'placeholder' => '',
                'choices' => $subcategories,
            ));
        };
        $formModifierState = function (FormInterface $form, State $state = null) {
            $cities = null === $state ? array() : $state->getCities();

            $form->add('city', 'entity', array(
                'class' => 'BidwebBundle:City',
                'placeholder' => '',
                'choices' => $cities,
            ));
        };
        $builder->addEventListener(
                FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($formModifier) {
            // this would be your entity, i.e. SportMeetup
            $data = $event->getData();

            $formModifier($event->getForm(), $data->getCategory(), $data->getState());
        }
        );



        $builder->get('state')->addEventListener(
                FormEvents::POST_SUBMIT, function (FormEvent $event) use ($formModifierState) {
            // It's important here to fetch $event->getForm()->getData(), as
            // $event->getData() will get you the client data (that is, the ID)
            $state = $event->getForm()->getData();

            // since we've added the listener to the child, we'll have to pass on
            // the parent to the callback functions!
            $formModifierState($event->getForm()->getParent(), $state);
        }
        );

        $builder->get('category')->addEventListener(
                FormEvents::POST_SUBMIT, function (FormEvent $event) use ($formModifierCat) {
            // It's important here to fetch $event->getForm()->getData(), as
            // $event->getData() will get you the client data (that is, the ID)
            $category = $event->getForm()->getData();

            // since we've added the listener to the child, we'll have to pass on
            // the parent to the callback functions!
            $formModifierCat($event->getForm()->getParent(), $category);
        }
        );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bidweb\BidwebBundle\Entity\Post'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'post';
    }

}
