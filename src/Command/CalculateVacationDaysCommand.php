<?php declare(strict_types = 1);

namespace App\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalculateVacationDaysCommand extends Command
{
    protected static $defaultName = 'vacation-calculator';

    /** @var LoggerInterface */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        parent::__construct();

        $this->logger = $logger;
    }

    protected function configure()
    {
        $this->setDescription('Calculates vacation days for given year for all employees');
    }

    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        return null;
    }
}
