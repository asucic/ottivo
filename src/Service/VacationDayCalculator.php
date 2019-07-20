<?php declare(strict_types = 1);

namespace App\Service;

use App\Resource\Employee;
use DateTime;

class VacationDayCalculator
{
    private const
        MINIMAL_VACATION_DAYS = 26,
        BONUS_YEARS = 5,
        SENIOR_EMPLOYEE_AGE = 30
    ;

    public function calculate(Employee $employee, int $year): int
    {
        # Increment a year so we can get contract time of target year
        $year++;
        $yearDateTime = DateTime::createFromFormat('d.m.Y', "01.01.$year");
        $vacationDays = $employee->getContractDays() ?? self::MINIMAL_VACATION_DAYS;

        # Can not have vacation days before contract started
        if ($yearDateTime < $employee->getDateOfContract()) {
            return 0;
        }

        # Add vacation days for senior employees
        $contractDuration = $employee->getDateOfContract()->diff($yearDateTime);
        if ($employee->getDateOfBirth()->diff($yearDateTime)->y >= self::SENIOR_EMPLOYEE_AGE) {
            $vacationDays = $vacationDays + ($contractDuration->y / self::BONUS_YEARS);
        }

        # Get partial days for contracts shorter than a year
        if ($contractDuration->y <= 0) {
            $vacationDays = $vacationDays * $contractDuration->m / 12;
        }

        return (int) floor($vacationDays);
    }
}
