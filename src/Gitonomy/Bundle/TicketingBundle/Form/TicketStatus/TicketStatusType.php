<?php
/**
 * This file is part of Gitonomy TicketingBundle.
 *
 * (c) Fabien MEYNARD <fabien.meynard@gmail.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Gitonomy\Bundle\TicketingBundle\Form\TicketStatus;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TicketStatusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',    'text',     array('label' => 'label.title'))
            ->add('isActive', 'checkbox', array('label' => 'label.isActive'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'Gitonomy\Bundle\TicketingBundle\Entity\TicketStatus',
            'translation_domain' => 'ticketing_bundle'
        ));
    }

    public function getName()
    {
        return 'ticket_status';
    }
}