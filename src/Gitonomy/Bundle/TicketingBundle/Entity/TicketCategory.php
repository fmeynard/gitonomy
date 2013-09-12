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

class TicketCategory
{
    protected $id;
    protected $title;
    protected $description;
    protected $isActive;
    protected $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle();
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

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setTickets($tickets)
    {
        $this->tickets = $tickets;

        return $this;
    }

    public function getTickets()
    {
        return $this->tickets;
    }
}