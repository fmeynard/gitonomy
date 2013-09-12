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


use Gitonomy\Bundle\TicketingBundle\Entity\TicketStatus;
use Gitonomy\Bundle\WebsiteBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TicketStatusController extends Controller
{
    public function indexAction()
    {
        return $this->render('GitonomyTicketingBundle:index.html.twig', array(
                'statuses' => $this->getRepository('GitonomyTicketingBundle:TicketStatus')->findAllOrderByTitle()
            ));
    }

    public function createAction(Request $request)
    {
        $ticketStatus = new TicketStatus();
        $form         = $this->createForm('ticket_status', $ticketStatus);

        if ('POST' == $request->getMethod() && $form->submit($ticketStatus)->isValid()) {
            $this->persistEntity($ticketStatus);
            $this->setFlash('success', $this->trans('notice.created', array(), 'ticket_status'));

            return $this->redirect($this->generateUrl('ticket_status_index'));
        }

        return $this->render('GitonomyTicketingBundle:TicketStatus:index.html.twig', array(
                'form' => $form->createView()
            ));
    }

    public function updateAction(Request $request)
    {
        $ticketStatus = $this->getRepository('GitonomyTicketingBundle:TicketStatus')->find($request->get('id'));
        $form         = $this->createForm('ticket_status', $ticketStatus);

        if ('POST' == $request->getMethod() && $form->submit($request)->isValid()) {
            $this->flush($ticketStatus);
            $this->setFlash('success', $this->trans('notice.updated', array(), 'ticket_status'));

            return $this->redirect($this->generateUrl('ticket_status_index'));
        }

        return $this->render('GitonomyTicketingBundle:TicketStatus:index.html.twig', array(
               'form' => $form->createView()
            ));
    }

    public function deleteAction(Request $request)
    {
        $ticketStatus = $this->getRepository('GitonomyTicketingBundle:TicketStatus')->find($request->get('id'));
        $this->removeEntity($ticketStatus);
        $this->setFlash('success', $this->trans('notice.deleted', array(), 'ticket_status'));

        return $this->redirect($this->generateUrl('ticket_status_index'));
    }
}