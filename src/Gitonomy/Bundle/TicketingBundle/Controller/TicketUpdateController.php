<?php

/**
 * This file is part of Gitonomy TicketingBundle.
 *
 * (c) Fabien MEYNARD <fabien.meynard@gmail.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Gitonomy\Bundle\TicketingBundle\Controller;

use Gitonomy\Bundle\TicketingBundle\Entity\TicketUpdate;
use Gitonomy\Bundle\WebsiteBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TicketUpdateController extends Controller
{
    public function createShort(Request $request)
    {
        $ticket = $this
            ->getRepository('GitonomyTicketingBundle:Ticket')
            ->find($request->get('id'));

        if (!$ticket) {

            throw new HttpException(404);
        }

        $ticketUpdate = new TicketUpdate($ticket);
        $form = $this->createForm('ticket_short_update', $ticketUpdate);
        if ('POST' == $request->getMethod() && $form->submit($request)->isValid()) {
            $this->get('ticket_service')->addUpdate($ticket, $ticketUpdate);
            $this->setFlash('success', $this->trans('notice.created'), array(), 'ticketing_bundle');

            return $this->redirect($this->generateUrl('ticket_view', array('id' => $ticket->getId())));
        }

        return $this->render('GitonomyTicketingBundle:TicketUpdate:shortForm.html.twig', array(
            'ticket' => $ticket,
            'form'   => $form->createView()
        ));
    }

    public function createLong(Request $request)
    {
        $ticket = $this
            ->getRepository('GitonomyTicketingBundle:Ticket')
            ->find($request->get('id'));

        if (!$ticket) {

            throw new HttpException(404);
        }

        $ticketUpdate = new TicketUpdate($ticket);
        $form = $this->createForm('ticket_long_update', $ticketUpdate);
        if ('POST' == $request->getMethod() && $form->submit($request)->isValid()) {
            $this->get('ticket_service')->addUpdate($ticket, $ticketUpdate);
            $this->setFlash('success', $this->trans('notice.created'), array(), 'ticketing_bundle');

            return $this->redirect($this->generateUrl('ticket_view', array('id' => $ticket->getId())));
        }

        return $this->render('GitonomyTicketingBundle:TicketUpdate:longForm.html.twig', array(
            'ticket' => $ticket,
            'form'   => $form->createView()
        ));
    }
}