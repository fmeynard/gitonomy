<?php

/**
 * This file is part of Gitonomy TicketingBundle.
 *
 * (c) Fabien MEYNARD <fabien.meynard@gmail.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Gitonomy\Bundle\TicketingBundle\Entity;


class TicketUpdate
{
    protected $id;
    protected $ticket;
    protected $createdBy;
    protected $createdAt;
    protected $content;
    protected $oldStatus;
    protected $newStatus;
    protected $oldCategory;
    protected $newCategory;
    protected $oldTracker;
    protected $newTracker;
    protected $oldProject;
    protected $newProject;
    protected $oldPriority;
    protected $newPriority;

    public function __construct(Ticket $ticket)
    {
        $this->setTicket($ticket);
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTicket(Ticket $ticket)
    {
        $this->ticket = $ticket;

        return $this;
    }

    public function getTicket()
    {
        return $this->ticket;
    }

    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setOldStatus($oldStatus)
    {
        $this->oldStatus = $oldStatus;

        return $this;
    }

    public function getOldStatus()
    {
        return $this->getOldStatus();
    }

    public function setNewStatus($newStatus)
    {
        $this->newStatus = $newStatus;

        return $this;
    }

    public function getNewStatus()
    {
        return $this->newStatus;
    }

    public function setOldCategory($oldCategory)
    {
        $this->oldCategory = $oldCategory;

        return $this;
    }

    public function getOldCategory()
    {
        return $this->oldCategory;
    }

    public function setNewCategory($newCategory)
    {
        $this->newCategory = $newCategory;

        return $this;
    }

    public function getNewCategory()
    {
        return $this->newCategory;
    }

    public function setOldTracker($oldTracker)
    {
        $this->oldTracker = $oldTracker;

        return $this;
    }

    public function getOldTracker()
    {
        return $this->oldTracker;
    }

    public function setNewTracker($newTracker)
    {
        $this->newTracker = $newTracker;

        return $this;
    }

    public function getNewTracker()
    {
        return $this->newTracker;
    }

    public function setOldProject($oldProject)
    {
        $this->oldProject = $oldProject;

        return $this;
    }

    public function getOldProject()
    {
        return $this->oldProject;
    }

    public function setNewProject($newProject)
    {
        $this->newProject = $newProject;

        return $this;
    }

    public function getNewProject()
    {
        return $this->newProject;
    }

    public function setOldPriority($oldPriority)
    {
        $this->oldPriority = $oldPriority;

        return $this;
    }

    public function getOldPriority()
    {
        return $this->oldPriority;
    }

    public function setNewPriority($newPriority)
    {
        $this->newPriority = $newPriority;

        return $this;
    }

    public function getNewPriority()
    {
        return $this->newPriority;
    }
}