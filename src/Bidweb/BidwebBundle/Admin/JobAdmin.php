<?php

namespace Bidweb\BidwebBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JobAdmin
 *
 * @author HAMMAMI
 */
class JobAdmin extends Admin {

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('getCategoryOptionsFromTag'); // Action gets added automatically
      //  $collection->add('view', $this->getRouterIdParameter().'/view');
    }
    
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper) {
        // get the current Image instance
        $image = $this->getSubject();

        // use $fileFieldOptions so we can add other options to the field
        $fileFieldOptions = array('required' => false);
        if ($image && ($webPath = $image->getWebPath())) {
            // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request')->getBasePath() . '/' . $webPath;

            // add a 'help' option containing the preview's img tag
            $fileFieldOptions['help'] = '<img src="' . $fullPath . '" class="admin-preview" width="100" height="100"/>';
        }


        $formMapper
                ->add('user', 'entity', array('label' => 'User', 'class' => 'Bidweb\UserBundle\Entity\User'))
                ->add('title', 'text')
                ->add('companyName', 'text')
                ->add('skills', 'text')
                ->add('slug', 'text')
                ->add('address', 'text')
                ->add('state', 'entity', array('label' => 'State', 'class' => 'Bidweb\BidwebBundle\Entity\State'))
                 ->add('city', 'entity', array('label' => 'City', 'class' => 'Bidweb\BidwebBundle\Entity\City'))
                ->add('duration', 'entity', array('label' => 'Duration', 'class' => 'Bidweb\BidwebBundle\Entity\Duration'))
                ->add('file', 'file', $fileFieldOptions)
                ->add('workingType', 'entity', array('label' => 'Working Type',
                    'class' => 'Bidweb\BidwebBundle\Entity\WorkingType'))
                ->add('description', 'textarea')
        ;
        
        
        
        $formMapper->add('subcategory', 'entity', array(
            'class' => 'BidwebBundle:SubCategory',
            'query_builder' => function(\Doctrine\ORM\EntityRepository $er) {
                return $er->createQueryBuilder('u')
                        ->where('u.category = 5')
                                ->orderBy('u.id', 'ASC');
            },
        ));
            
//        $formModifier = function (FormInterface $form, State $state = null) {
//
//            $cities = null === $state ? array() : $state->getCities();
//
//            $form->add('city', 'entity', array(
//                'class' => 'BidwebBundle:City',
//                'placeholder' => '',
//                'choices' => $cities,
//            ));
//        };
//        
//        $formMapper->addEventListener(
//            FormEvents::PRE_SET_DATA,
//            function (FormEvent $event) use ($formModifier) {
//                // this would be your entity, i.e. SportMeetup
//                $data = $event->getData();
//
//                $formModifier($event->getForm(),$data->getState());
//            }
//        );
//        
//       
//        
//        $formMapper->get('state')->addEventListener(
//            FormEvents::POST_SUBMIT,
//            function (FormEvent $event) use ($formModifier) {
//                // It's important here to fetch $event->getForm()->getData(), as
//                // $event->getData() will get you the client data (that is, the ID)
//                $state = $event->getForm()->getData();
//
//                // since we've added the listener to the child, we'll have to pass on
//                // the parent to the callback functions!
//                $formModifier($event->getForm()->getParent(), $state);
//            }
//        );
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('user')
                ->add('title')
                ->add('state')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('title')
                ->add('slug')
                ->add('state')
                ->add('user')
        ;
    }

    
    public function getTemplate($name) {
        switch ($name) {
        case 'edit':
            return 'BidwebBundle:Job:job_edit.html.twig';
            break;
        default:
            return parent::getTemplate($name);
            break;
    }
    }

}
