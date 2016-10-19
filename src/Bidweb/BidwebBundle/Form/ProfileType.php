<?php

namespace Bidweb\BidwebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ProfileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text',array('label' => 'title',
            'translation_domain' => 'messages','attr'=>array('class'=>'form-control')))
            ->add('diploma', 'text',array('label' => 'diploma1',
            'translation_domain' => 'messages','attr'=>array('class'=>'form-control')))
            ->add('diploma2', 'text',array('label' => 'diploma2',
            'translation_domain' => 'messages','required'=> false,'attr'=>array('class'=>'form-control')))
            ->add('diploma3', 'text',array('label' => 'diploma3',
            'translation_domain' => 'messages','required'=> false,'attr'=>array('class'=>'form-control')))
            ->add('certification', 'text',array('label' => 'certif1',
            'translation_domain' => 'messages','required'=> false,'attr'=>array('class'=>'form-control')))
            ->add('certification2', 'text',array('label' => 'certif2',
            'translation_domain' => 'messages','required'=> false,'attr'=>array('class'=>'form-control')))
            ->add('certification3', 'text',array('label' => 'certif3',
            'translation_domain' => 'messages','required'=> false,'attr'=>array('class'=>'form-control')))
//            ->add('fileImage', 'file', array('image_path' => 'webPathImage','label' => 'image',
//            'translation_domain' => 'messages','required'=> false,'attr'=>array('class'=>'form-control')))
//            ->add('fileCv', 'file', array('filecv_path' => 'webPathCv','label' => 'cv',
//            'translation_domain' => 'messages'))
//            ->add('fileResume', 'file', array('fileresume_path' => 'webPathResume','label' => 'resume',
//            'translation_domain' => 'messages'))
            ->add('description','textarea',array('label' => 'detail',
            'translation_domain' => 'messages','attr'=>array('class'=>'form-control')));
        ;
        
//        $builder->add('subcategory', 'entity', array(
//            'class' => 'BidwebBundle:SubCategory',
//            'query_builder' => function(EntityRepository $er) {
//                return $er->createQueryBuilder('u')
//                        ->where('u.category = 6')
//                                ->orderBy('u.name', 'ASC');
//            },'label' => 'sub.cat',
//            'translation_domain' => 'messages','attr'=>array('class'=>'form-control')
//        ))->add('description','textarea',array('label' => 'detail',
//            'translation_domain' => 'messages','attr'=>array('class'=>'form-control')));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bidweb\BidwebBundle\Entity\Profile'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bidweb_bidwebbundle_profile';
    }
}
