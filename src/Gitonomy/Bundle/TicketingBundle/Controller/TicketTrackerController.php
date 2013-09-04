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


use Gitonomy\Bundle\TicketingBundle\Entity\TicketTracker;
use Gitonomy\Bundle\WebsiteBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TicketTrackerController extends Controller
{
    public function indexAction()
    {
        return $this->render('GitonomyTicketingBundle:Tracker:index.html.twig', array(
            'trackers' => $this->getRepository('GitonomyTicketingBundle:TicketTracker')->findAllOrderedByTitle()
        ));
    }

    public function createAction(Request $request)
    {
        $ticketTracker = new TicketTracker();
        $form          = $this->createForm('ticket_tracker', $ticketTracker);

        if ('POST' == $request->getMethod() && $form->submit($request)->isValid()) {
            $this->persistEntity($ticketTracker);
            $this->setFlash('success', $this->trans('notice.created', array(), 'ticket_tracker'));

            return $this->redirect($this->generateUrl('ticket_tracker_index'));
        }

        return $this->render('GitonomyTicketingBundle:TicketTracker:new.html.twig', array(
                'form' => $form->createView()
            ));
    }

    public function editAction(Request $request)
    {
        $ticketTracker = $this->getRepository('GitonomyTicketingBundle:TicketTracker')->find($request->get('id'));
        $form          = $this->createForm('ticket_tracker', $ticketTracker);

        if ('POST' == $request->getMethod() && $form->submit($request)->isValid()) {
            $this->flush($ticketTracker);
            $this->setFlash('success', $this->trans('notice.updated', array(), 'ticket_tracker'));

            return $this->redirect($this->generateUrl('ticket_tracker_index'));
        }

        return $this->render('GitonomyTicketingBundle:TicketTracker:new.html.twig', array(
                'form' => $form->createView()
            ));
    }

    public function deleteAction(Request $request)
    {
        $ticketTracker = $this->getRepository('GitonomyTicketingBundle:TicketTracker')->find($request->get('id'));
        $this->removeEntity($ticketTracker);
        $this->setFlash('success', $this->trans('notice.deleted', array(), 'ticket_tracker'));

        return $this->redirect($this->generateUrl('ticket_tracker_index'));
    }
}