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


use Gitonomy\Bundle\TicketingBundle\Entity\TicketPriority;
use Gitonomy\Bundle\WebsiteBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TicketPriorityController extends Controller
{
    public function indexAction()
    {
        return $this->render('GitonomyTicketingBundle:TicketPriority:index.html.twig', array(
                'priorities' => $this->getRepository('GitonomyTicketingBundle:TicketPriority')->findAllOrderedByTitle()
            ));
    }

    public function createAction(Request $request)
    {
        $ticketPriority = new TicketPriority();
        $form           = $this->createForm('ticket_priority', $ticketPriority);

        if ('POST' == $request->getMethod() && $form->submit($request)->isValid()) {
            $this->persistEntity($ticketPriority);
            $this->setFlash('success', $this->trans('notice.created', array(), 'ticket_priority'));

            return $this->redirect($this->generateUrl('ticket_priority_index'));
        }

        return $this->render('GitonomyTicketingBundle:TicketPriority:edit.html.twig', array(
                'form' => $form->createView()
            ));
    }

    public function updateAction(Request $request)
    {
        $ticketPriority = $this->getRepository('GitonomyTicketingBundle:TicketPriority')->find($request->get('id'));
        $form           = $this->createForm('ticket_priority', $ticketPriority);

        if ('POST' == $request->getMethod() && $form->submit($request)->isValid()) {
            $this->flush($ticketPriority);
            $this->setFlash('success', $this->trans('notice.updated', array(), 'ticket_priority'));

            return $this->redirect($this->generateUrl('ticket_priority_index'));
        }

        return $this->render('GitnonomyTicketingBundle:TicketPriority:edit.html.twig', array(
                'form' => $form->createView()
            ));
    }

    public function deleteAction(Request $request)
    {
        $ticketPriority = $this->getRepository('GitonomyTicketingBundle:TicketPriority')->find($request->get('id'));
        $this->removeEntity($ticketPriority);
        $this->setFlash('success', $this->trans('notice.deleted', array(), 'ticket_priority'));

        return $this->redirect($this->generateUrl('ticket_priority_index'));
    }
}