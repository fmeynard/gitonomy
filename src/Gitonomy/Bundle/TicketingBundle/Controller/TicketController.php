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


use Gitonomy\Bundle\TicketingBundle\Entity\Ticket;
use Gitonomy\Bundle\WebsiteBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TicketController extends Controller
{
    public function indexAction(Request $request)
    {
        $tickets = $this
            ->getRepository('GitonomyTicketingBundle:Ticket')
            ->findByFilters($request->get('filters', array()));

        return $this->render('GitonomyTicketingBundle:Ticket:index.html.twig', array(
            'tickets' => $tickets
        ));
    }

    public function viewAction(Request $request)
    {
        $ticket = $this->getRepository('GitonomyTicketingBundle:Ticket')->find($request->get('id'));

        return $this->render('GitonomyTicketingBundle:Ticket:view.html.twig', array(
            'ticket' => $ticket
        ));
    }

    public function createAction(Request $request)
    {
        $ticket = new Ticket();
        $form   = $this->createForm('ticket', $ticket);

        if ('POST' == $request->getMethod() && $form->submit($request)->isValid()) {
            $this->persistEntity($ticket);
            $this->setFlash('success', $this->trans('notice.created', array(), 'ticketing_bundle'));

            return $this->redirect($this->generateUrl('ticket_index'));
        }

        return $this->render('GitonomyTicketingBundle:Ticket:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function updateAction(Request $request)
    {
        $ticket = $this->getRepository('GitonomyTicketing:Ticket')->find($request->get('id'));
        $form   = $this->createForm('ticket', $ticket);

        if ('POST' == $request->getMethod() && $form->submit($request)->isValid()) {
            $this->flush($ticket);
            $this->setFlash('success', $this->trans('notice.updated', array(), 'ticketing_bundle'));

            return $this->redirect($this->generateUrl('ticket_index'));
        }

        return $this->render('GitonomyTicketingBundle:Ticket:edit.html.twig');
    }

    public function deleteAction(Request $request)
    {
        $ticket = $this->getRepository('GitonomyTicketingBundle:Ticket')->find($request->get('id'));

        return $this->render('GitonomyTicketingBundle:Ticket:view.html.twig', array(
            'ticket' => $ticket
        ));
    }
}