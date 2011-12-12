<?php

namespace Gitonomy\Bundle\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

use Gitonomy\Bundle\CoreBundle\Entity\User;

/**
 * Shell command for creating a user.
 *
 * @author Alexandre Salomé <alexandre.salome@gmail.com>
 */
class UserCreateCommand extends ContainerAwareCommand
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('gitonomy:user-create')
            ->addArgument('username', InputArgument::REQUIRED, 'Username')
            ->addArgument('password', InputArgument::REQUIRED, 'Password of the user')
            ->addArgument('email',    InputArgument::REQUIRED, 'Email of the user')
            ->addArgument('fullname', InputArgument::REQUIRED, 'Fullname of the user')
            ->addArgument('timezone', InputArgument::OPTIONAL, 'Timezone of the user', date_default_timezone_get())
            ->setDescription('Creates a new user')
            ->setHelp(<<<EOF
The <info>gitonomy:user-create</info> task creates a new user.

EOF
            )
        ;
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em   = $this->getContainer()->get('doctrine')->getEntityManager();
        $user = new User();
        $encoder = $this->getContainer()->get('security.encoder_factory')->getEncoder($user);

        $user->setUsername($input->getArgument('username'));
        $user->setPassword($input->getArgument('password'));
        $user->setEmail($input->getArgument('email'));
        $user->setFullname($input->getArgument('fullname'));
        $user->setTimezone($input->getArgument('timezone'));
        $user->setPassword($encoder->encodePassword($user->getPassword(), $user->regenerateSalt()));

        $em->persist($user);
        $em->flush();
    }
}