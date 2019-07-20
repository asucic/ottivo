<?php declare(strict_types = 1);

namespace App\Command;

use App\Resource\Employee;
use App\Service\VacationDayCalculator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalculateVacationDaysCommand extends Command
{
    protected static $defaultName = 'vacation-calculator';

    /** @var VacationDayCalculator */
    private $calculator;

    public function __construct(VacationDayCalculator $calculator)
    {
        parent::__construct();

        $this->calculator = $calculator;
    }

    protected function configure()
    {
        $this
            ->addArgument('year', InputArgument::REQUIRED, 'Year of vacation days calculation.')
            ->setDescription('Calculates vacation days for given year for all employees')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $year = (int) $input->getArgument('year');
        $employees = json_decode(file_get_contents(DATA_DIRECTORY . '/employees.json'), true);

        $table = (new Table($output))
            ->setHeaderTitle("Employee Vacation Days for year $year")
            ->setHeaders([
                    'Employee Name',
                    'Date Of Birth',
                    'Date Of Contract',
                    'Contract Days',
                    'Vacation Days',
                ]
            );

        foreach ($employees as $employeeData) {
            $employee = new Employee($employeeData);
            $vacationDays = $this->calculator->calculate($employee, $year);

            $table->addRow([
                $employee->getName(),
                $employee->getDateOfBirth()->format('d.m.Y'),
                $employee->getDateOfContract()->format('d.m.Y'),
                $employee->getContractDays(),
                $vacationDays
            ]);
        }

        $table->render();

        return null;
    }
}
