<?php
/**
 * This file is part of Gitonomy TicketingBundle.
 *
 * (c) Fabien MEYNARD <fabien.meynard@gmail.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Gitonomy\Bundle\TicketingBundle\Form\TicketUpdate;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TicketUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content',    'textarea',     array('label' => 'label.content'))
            ->add('newProject', 'entity', array(
                    'label'         => 'label.project',
                    'class'         => 'GitonomyCoreBundle:Project',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->findAll();
                    }
                ))
            ->add('newCategory', 'entity',  array(
                    'label' => 'label.category',
                    'class' => 'GitonomyTicketingBundle:TicketCategory',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->findActiveOrderByTitleQB();
                    }
                ))
            ->add('newTracker', 'entity',  array(
                    'label' => 'label.tracker',
                    'class' => 'GitonomyTicketingBundle:TicketTracker',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->findActiveOrderByTitleQB();
                    }
                ))
            ->add('newPriority', 'entity',  array(
                    'label' => 'label.priority',
                    'class' => 'GitonomyTicketingBundle:TicketPriority',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->findAllOrderByScoreQB();
                    }
                ))
            ->add('newStatus', 'entity',  array(
                    'label' => 'label.status',
                    'class' => 'GitonomyTicketingBundle:TicketPriority',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->findAllOrderByScoreQB();
                    }
                ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class'         => 'Gitonomy\Bundle\TicketingBundle\Entity\TicketUpdate',
                'translation_domain' => 'ticketing_bundle'
            ));
    }

    public function getName()
    {
        return 'ticket_update';
    }
}