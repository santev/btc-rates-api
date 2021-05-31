<?php

namespace App\Command;

use App\Service\Stock;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class QuotesUpdateCommand extends Command {

    private $stock;
    protected static $defaultName = 'app:quotes-update';
    protected static $defaultDescription = 'Get a fresh data from a stock market API';

    public function __construct(Stock $stock) {
        $this->stock = $stock;
        parent::__construct();
    }

    protected function configure(): void {
        $this->setDescription(self::$defaultDescription);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        $quotes_arr = $this->stock->getQuotes(); //get from stock market
        $result = $this->stock->updateQuotes($quotes_arr); //save to database

        $output->writeln('Saved new quotes, last ID is ' . $result);

        return Command::SUCCESS;
    }

}
