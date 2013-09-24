<?php

/**
 * This file is part of Gitonomy TicketingBundle.
 *
 * (c) Fabien MEYNARD <fabien.meynard@gmail.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */


namespace Gitonomy\Bundle\TicketingBundle\Service;

use Doctrine\ORM\EntityManager;
use Gitonomy\Bundle\TicketingBundle\Entity\Ticket;
use Gitonomy\Bundle\TicketingBundle\Entity\TicketUpdate;
use Symfony\Component\Security\Core\SecurityContext;

class TicketService
{
    protected $em;
    protected $securityContext;

    public function __construct(EntityManager $em, SecurityContext $securityContext)
    {
        $this->em = $em;
        $this->securityContext = $securityContext;
    }

    public function addUpdate(Ticket $ticket, TicketUpdate $ticketUpdate)
    {
        $updateTicket = false;

        if ($ticketUpdate->getNewStatus()) {
            $ticketUpdate->setOldStatus($ticket->getTicketStatus());
            $ticket->setTicketStatus($ticketUpdate->getNewStatus());
            $updateTicket = true;
        }

        if ($ticketUpdate->getNewCategory()) {
            $ticketUpdate->setOldCategory($ticket->getTicketCategory());
            $ticket->setTicketCategory($ticketUpdate->getNewCategory());
            $updateTicket = true;
        }

        if ($ticketUpdate->getNewTracker()) {
            $ticketUpdate->setOldTracker($ticket->getTicketTracker());
            $ticket->setTicketTracker($ticketUpdate->getNewTracker());
            $updateTicket = true;
        }

        if ($ticketUpdate->getNewProject()) {
            $ticketUpdate->setOldProject($ticket->getProject());
            $updateTicket = true;
        }

        if ($ticketUpdate->getNewPriority()) {
            $ticketUpdate->setOldPriority($ticket->getTicketPriority());
            $updateTicket = true;
        }

        if ($updateTicket) {
            $ticket->setUpdatedAt(new \DateTime());
            $ticket->setUpdatedBy($this->securityContext->getToken()->getUser());
        }
        $ticketUpdate->setCreatedBy($this->securityContext->getToken()->getUser());

        $this->em->persist($ticketUpdate);
        $this->em->flush();
    }
}