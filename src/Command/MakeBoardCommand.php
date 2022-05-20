<?php

namespace App\Command;

use App\Entity\GameBoard;
use phpDocumentor\Reflection\Types\Boolean;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MakeBoardCommand extends Command
{
    protected static $defaultName = 'make:board';
    protected static $defaultDescription = 'Add in base game board';

    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('name', InputArgument::REQUIRED, 'Board Name')
            ->addArgument('line_length', InputArgument::REQUIRED, 'Board line length')
            ->addArgument('board', InputArgument::REQUIRED, 'Write board in line')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $board = new GameBoard();

        if ($input->getOption('help')) {
            $io->note("");
            return 0;
        }

        $board->setName($input->getArgument('name'));
        $board->setLinelenght($input->getArgument('line_length'));
        $board->setBoard($input->getArgument('board'));
        $board->setIsAvailable(true);

        $this->em->persist($board);
        $this->em->flush();

        $io->success('Ready.');

        return 0;
    }
}
