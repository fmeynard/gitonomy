<?php

/**
 * This file is part of Gitonomy TicketingBundle.
 *
 * (c) Fabien MEYNARD <fabien.meynard@gmail.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Gitonomy\Bundle\TicketingBundle\Entity\Repository;


use Doctrine\ORM\EntityRepository;

class TicketTrackerRepository extends EntityRepository
{
    public function findAllOrderedByTitle()
    {
        return $this
            ->createQueryBuilder('p')
            ->orderBy('p.title')
            ->getQuery()
            ->execute();
    }

    public function findActiveOrderedByTitle()
    {

    }
}