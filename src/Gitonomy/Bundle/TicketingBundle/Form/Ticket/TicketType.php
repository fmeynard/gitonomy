<?php
/**
 * This file is part of Gitonomy TicketingBundle.
 *
 * (c) Fabien MEYNARD <fabien.meynard@gmail.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Gitonomy\Bundle\TicketingBundle\Form\Ticket;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ticketCategory', 'entity',  array(
                    'label' => 'label.category',
                    'class' => 'GitonomyTicketingBundle:TicketCategory',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->findActiveOrderByTitleQB();
                    }
                ))
            ->add('ticketTracker', 'entity',  array(
                    'label' => 'label.tracker',
                    'class' => 'GitonomyTicketingBundle:TicketTracker',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->findActiveOrderByTitleQB();
                    }
                ))
            ->add('ticketPriority', 'entity',  array(
                'label' => 'label.priority',
                'class' => 'GitonomyTicketingBundle:TicketPriority',
                'query_builder' => function(EntityRepository $er) {
                    return $er->findAllOrderByScoreQB();
                }
            ))
            ->add('ticketStatus', 'entity',  array(
                'label' => 'label.status',
                'class' => 'GitonomyTicketingBundle:TicketPriority',
                'query_builder' => function(EntityRepository $er) {
                    return $er->findAllOrderByScoreQB();
                }
            ))
            ->add('title',   'text',     array('label' => 'label.title'))
            ->add('content', 'textarea', array('label' => 'label.content'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class'         => 'Gitonomy\Bundle\TicketingBundle\Entity\Ticket',
                'translation_domain' => 'ticketing_bundle'
            ));
    }

    public function getName()
    {
        return 'ticket';
    }
}