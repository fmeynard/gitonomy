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


use Gitonomy\Bundle\TicketingBundle\Entity\TicketCategory;
use Gitonomy\Bundle\WebsiteBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TicketCategoryController extends Controller
{
    public function indexAction()
    {
        return $this->render('GitonomyTicketingBundle:TicketCategory:index.html.twig', array(
            'categories' => $this
                ->getRepository('GitonomyTicketingBundle:TicketCategory')
                ->findAllOrderByTitle()
        ));
    }

    public function createAction(Request $request)
    {
        $ticketCategory = new TicketCategory();
        $form           = $this->createForm('ticket_category', $ticketCategory);

        if ('POST' == $request->getMethod() && $form->submit($request)->isValid()) {
            $this->persistEntity($ticketCategory);
            $this->setFlash('success', $this->trans('notice.created', array(), 'ticket_category'));

            return $this->redirect($this->generateUrl('ticket_category_index'));
        }

        return $this->render('GitonomyTicketingBundle:TicketCategory:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Request $request)
    {
        $ticketCategory = $this->getRepository('GitonomyTicketingBundle:TicketCategory')->find($request->get('id'));
        $form           = $this->createForm('ticket_category', $ticketCategory);

        if ('POST' == $request->getMethod() && $form->submit($request)->isValid()) {
            $this->flush($ticketCategory);
            $this->setFlash('success', $this->trans('notice.updated', array(), 'ticket_category'));

            return $this->redirect($this->generateUrl('ticket_category_index'));
        }

        return $this->render('GitonomyTicketingBundle:TicketCategory:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction(Request $request)
    {
        $ticketCategory = $this->getRepository('GitonomyTicketingBundle:TicketCategory')->find($request->get('id'));
        $this->removeEntity($ticketCategory);
        $this->setFlash('success', $this->trans('notice.deleted', array(), 'ticket_category'));

        return $this->redirect($this->generateUrl('ticket_category_index'));
    }
}