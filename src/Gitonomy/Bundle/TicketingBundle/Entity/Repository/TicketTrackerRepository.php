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
    public function findAllOrderByTitle()
    {
        return $this
            ->createQueryBuilder('p')
            ->orderBy('p.title')
            ->getQuery()
            ->execute();
    }

    public function findActiveOrderByTitleQB()
    {
        return $this
            ->createQueryBuilder('p')
            ->where('p.isActive = :active')
            ->setParameter('active', true)
            ->orderBy('p.title');
    }

    public function findActiveOrderByTitle()
    {
        return $this
            ->findActiveOrderByTitleQB()
            ->getQuery()
            ->execute();
    }
}