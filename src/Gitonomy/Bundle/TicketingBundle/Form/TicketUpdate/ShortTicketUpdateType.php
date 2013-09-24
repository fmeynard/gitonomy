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

use Symfony\Component\Form\FormBuilderInterface;

class ShortTicketUpdateType extends TicketUpdateType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->remove('newTracker')
            ->remove('newCategory')
            ->remove('newPriority')
            ->remove('newProject');

    }

    public function getName()
    {
        return 'ticket_short_update';
    }
}