<?php

namespace Bidweb\BidwebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MessageListType
 *
 * @author HAMMAMI
 */
class MessageListType extends AbstractType {

    private $queryBuilder = null;
    private $userId = 0;
    private $isRceiver = true;
    private $page = 0;
    private $limit = 5;

    public function __construct($userId, $page, $limit, $isRceiver = true) {
        $this->userId = $userId;
        $this->isRceiver = $isRceiver;
        $this->page = $page;
        $this->limit = $limit;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        if ($this->isRceiver) {
            $this->queryBuilder = function(EntityRepository $er) {
                return $er->createQueryBuilder('b')
                                ->select('b')
                                ->where('b.receiver = :id')
                                ->orderBy('b.created', 'DESC')
                                ->setParameter('id', $this->userId)
                                ->setFirstResult($this->page*10)
                                ->setMaxResults($this->limit)
                ;
            };
        } else {
            $this->queryBuilder = function(EntityRepository $er) {
                return $er->createQueryBuilder('b')
                                ->select('b')
                                ->where('b.sender = :id')
                                ->orderBy('b.created', 'DESC')
                                ->setParameter('id', $this->userId)
                                ->setFirstResult($this->page*10)
                                ->setMaxResults($this->limit);
            };
        }

        $builder
                ->add('messages', 'entity', array(
                    'class' => 'BidwebBundle:Message',
                    'query_builder' => $this->queryBuilder,
                    'property' => 'id',
                    'required' => false,
                    'expanded' => true,
                    'multiple' => true,
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'MessgaeList';
    }

}
