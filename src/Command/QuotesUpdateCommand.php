<?php

namespace App\Command;

use App\Repository\QuotesRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class QuotesUpdateCommand extends Command {

    private $quotesRepository;
    protected static $defaultName = 'app:quotes-update';
    protected static $defaultDescription = 'Get a fresh data from a stock market API';

    public function __construct(QuotesRepository $quotesRepository) {
        $this->quotesRepository = $quotesRepository;

        parent::__construct();
    }

    protected function configure(): void {
        $this
                ->setDescription(self::$defaultDescription)
                ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
                ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
//        $io = new SymfonyStyle($input, $output);
//        $arg1 = $input->getArgument('arg1');
//
//        if ($arg1) {
//            $io->note(sprintf('You passed an argument: %s', $arg1));
//        }
//
//        if ($input->getOption('option1')) {
//            // ...
//        }
//
//        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }

}
