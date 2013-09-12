<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fab
 * Date: 09/09/13
 * Time: 01:49
 * To change this template use File | Settings | File Templates.
 */

namespace Gitonomy\Bundle\TicketingBundle\Listener;

use Doctrine\Common\Util\Debug;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Gitonomy\Bundle\CoreBundle\Entity\User;
use Gitonomy\Bundle\TicketingBundle\Entity\Ticket;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\SecurityContext;

class TicketListener
{
    /** @var ContainerInterface  */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    protected function index(LifecycleEventArgs $args)
    {
        $entity          = $args->getEntity();
        $securityContext = $this->container->get('security.context');
        $user            = $securityContext->getToken()->getUser();

        if ($entity instanceof Ticket) {
            if (
                false == $securityContext->getToken()->isAuthenticated() ||
                false == ($user instanceof User)
            ) {

                throw new \Exception('User have to be logged to create/update a ticket');
            }

            if ($entity->getId()) {
                $entity->setUpdatedBy($securityContext->getToken()->getUser());
                $entity->setUpdatedAt(new \DateTime());
            } else {
                $entity->setCreatedBy($securityContext->getToken()->getUser());
                $entity->setCreatedAt(new \DateTime());
            }
        }
    }
}