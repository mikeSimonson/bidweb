<?php

namespace Bidweb\BidwebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Bidweb\UserBundle\Entity\User;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\EntityRepository;


class ApplicationJobType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('message','textarea');


        $formModifier = function (FormInterface $form, User $user = null) {

           // $profiles = null === $user ? array() : $user->get();

            $form->add('profile', 'entity', array(
                'class' => 'BidwebBundle:Profile',
                'query_builder' => function(EntityRepository $er) use ($user) {
                    return $er->createQueryBuilder('u')
                                    ->where('u.user = :user')
                                    ->orderBy('u.title', 'ASC')
                            ->setParameter("user", $user);
                },
            ));

           
        };

        $builder->addEventListener(
                FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($formModifier) {
            // this would be your entity, i.e. SportMeetup
            $data = $event->getData();

            $formModifier($event->getForm(), $data->getUser());
        }
        );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bidweb\BidwebBundle\Entity\ApplicationJob'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'applicationjob';
    }

}
