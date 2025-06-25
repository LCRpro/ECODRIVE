<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:create-user',
    description: 'Crée un utilisateur test pour l’auth',
)]
class CreateUserCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('email', InputArgument::REQUIRED, 'Email de l’utilisateur');
        $this->addArgument('googleId', InputArgument::REQUIRED, 'Google ID (simulé)');
        $this->addArgument('name', InputArgument::OPTIONAL, 'Nom', 'Test User');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = new User();
        $user->setEmail($input->getArgument('email'));
        $user->setGoogleId($input->getArgument('googleId'));
        $user->setName($input->getArgument('name'));
        $user->setRoles(['ROLE_USER']);

        $this->em->persist($user);
        $this->em->flush();

        $output->writeln('<info>Utilisateur créé !</info>');
        return Command::SUCCESS;
    }
}