<?php
namespace Bidweb\BidwebBundle\Form\Extension;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImageTypeExtension
 *
 * @author HAMMAMI
 */
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImageTypeExtension extends AbstractTypeExtension
{
    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return 'file';
    }
    
    /**
     * Add the image_path option
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setOptional(array('image_path','filecv_path','fileresume_path'));
        
    }

    /**
     * Pass the image url to the view
     *
     * @param FormView $view
     * @param FormInterface $form
     * @param array $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (array_key_exists('image_path', $options)) {
            
            $parentData = $form->getParent()->getData();

            if (null !== $parentData) {
                $accessor = PropertyAccess::createPropertyAccessor();
                $imageUrl = $accessor->getValue($parentData, $options['image_path']);
               
                
            } else {
                 $imageUrl = null;
            }

            // set an "image_url" variable that will be available when rendering this field
            $view->vars['image_url'] = $imageUrl;
           $view->vars['typeup'] = 'img';
        }
        
        if (array_key_exists('filecv_path', $options)) {
            
            $parentData = $form->getParent()->getData();

            if (null !== $parentData) {
                $accessor = PropertyAccess::createPropertyAccessor();
                $imageUrl = $accessor->getValue($parentData, $options['filecv_path']);
                
            } else {
                 $imageUrl = null;
            }

            // set an "image_url" variable that will be available when rendering this field
            $view->vars['file_url'] = $imageUrl;
            $view->vars['typeup'] = 'file';
        }
        
        if (array_key_exists('fileresume_path', $options)) {
            
            $parentData = $form->getParent()->getData();

            if (null !== $parentData) {
                $accessor = PropertyAccess::createPropertyAccessor();
                $imageUrl = $accessor->getValue($parentData, $options['fileresume_path']);
                
            } else {
                 $imageUrl = null;
            }

            // set an "image_url" variable that will be available when rendering this field
            $view->vars['file_url'] = $imageUrl;
           $view->vars['typeup'] = 'file';
        }
    }
}