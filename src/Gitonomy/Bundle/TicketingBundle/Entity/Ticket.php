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


use Doctrine\Common\Collections\ArrayCollection;

class Ticket
{
    protected $id;
    protected $project;
    protected $ticketTracker;
    protected $ticketCategory;
    protected $ticketStatus;
    protected $ticketPriority;
    protected $title;
    protected $content;
    protected $createdBy;
    protected $updatedBy;
    protected $createdAt;
    protected $updatedAt;
    protected $ticketUpdates;

    public function __construct()
    {
        $this->ticketUpdates = new ArrayCollection();
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

    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    public function getProject()
    {
        return $this->project;
    }

    public function setTicketTracker($ticketTracker)
    {
        $this->ticketTracker = $ticketTracker;

        return $this;
    }

    public function getTicketTracker()
    {
        return $this->ticketTracker;
    }

    public function setTicketCategory($ticketCategory)
    {
        $this->ticketCategory = $ticketCategory;

        return $this;
    }

    public function getTicketCategory()
    {
        return $this->ticketCategory;
    }

    public function setTicketStatus($ticketStatus)
    {
        $this->ticketStatus = $ticketStatus;

        return $this;
    }

    public function getTicketStatus()
    {
        return $this->ticketStatus;
    }

    public function setTicketPriority($ticketPriority)
    {
        $this->ticketPriority = $ticketPriority;

        return $this;
    }

    public function getTicketPriority()
    {
        return $this->ticketPriority;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
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

    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setTicketUpdates($ticketUpdates)
    {
        $this->ticketUpdates = $ticketUpdates;

        return $this;
    }

    public function getTicketUpdates()
    {
        return $this->ticketUpdates;
    }
}