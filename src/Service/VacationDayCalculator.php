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

        # Set base vacation day number
        $vacationDays = $employee->getContractDays() ?? self::MINIMAL_VACATION_DAYS;

        # Add vacation days for senior employees
        $contractDuration = $employee->getDateOfContract()->diff($yearDateTime);
        if ($employee->getDateOfBirth()->diff(new DateTime())->y >= self::SENIOR_EMPLOYEE_AGE) {
            $vacationDays += $contractDuration->y / self::BONUS_YEARS;
        }

        # Get partial days for contracts shorter than a year
        if ($contractDuration->y <= 0) {
            $vacationDays = $vacationDays * $contractDuration->m / 12;
        }

        return (int) floor($vacationDays);
    }
}
