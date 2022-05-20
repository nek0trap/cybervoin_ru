<?php

namespace App\Command;

use App\Entity\Weapon;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UserWeaponCommand extends Command
{
    protected static $defaultName = 'user:weapon';
    protected static $defaultDescription = 'Add a short description for your command';


    /**
     * @var EntityManager
     */
    protected $em;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('Damage', InputArgument::REQUIRED, 'Weapon Damage')
            ->addArgument('Name', InputArgument::REQUIRED, 'Weapon Name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $damage = $input->getArgument('Damage');
        $name = $input->getArgument('Name');


        $weapon = new Weapon();
        $weapon->setDamage($damage);
        $weapon->setName($name);

        $this->em->persist($weapon);
        $this->em->flush();

        $io->success('WEAPON CREATE');

        return 0;
    }
}
