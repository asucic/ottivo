<?php declare(strict_types = 1);

namespace Test\Unit\Service;

use App\Resource\Employee;
use App\Service\VacationDayCalculator;
use DateTime;
use PHPUnit\Framework\TestCase;

class VacationDayCalculatorTest extends TestCase
{
    /** @var VacationDayCalculator */
    private $vacationDayCalculator;

    public function setUp(): void
    {
        $this->vacationDayCalculator = new VacationDayCalculator();
    }

    /** @test */
    public function can_have_no_less_than_26_vacation_days_without_special_contract()
    {
        $employee = new Employee([
            'name' => 'Test',
            'date_of_birth' => '01.01.1991',
            'contract_start_date' => '01.01.2000',
            'special_contract_days' => null,
        ]);

        $result = $this->vacationDayCalculator->calculate($employee, 2019);

        $this->assertGreaterThanOrEqual(26, $result);
    }

    /** @test */
    public function can_have_base_vacation_days_defined_by_special_contract()
    {
        $employee = new Employee([
            'name' => 'Test',
            'date_of_birth' => '01.01.1971',
            'contract_start_date' => '01.01.2000',
            'special_contract_days' => 24,
        ]);

        $result = $this->vacationDayCalculator->calculate($employee, 2020);

        $this->assertEquals(28, $result);
    }

    /** @test */
    public function can_have_additional_day_every_5_years_for_employees_older_than_30()
    {
        $employee = new Employee([
            'name' => 'Test',
            'date_of_birth' => '01.01.1973',
            'contract_start_date' => '01.01.2000',
            'special_contract_days' => null,
        ]);

        $result = $this->vacationDayCalculator->calculate($employee, 2020);

        $this->assertEquals(30, $result);
    }

    /** @test */
    public function can_have_vacation_days_for_6_months_of_employment()
    {
        $employee = new Employee([
            'name' => 'Test',
            'date_of_birth' => '01.01.1973',
            'contract_start_date' => '01.07.2000',
            'special_contract_days' => null,
        ]);

        $result = $this->vacationDayCalculator->calculate($employee, 2000);

        $this->assertEquals(13, $result);
    }

    /** @test */
    public function can_have_vacation_days_for_9_months_of_employment()
    {
        $employee = new Employee([
            'name' => 'Test',
            'date_of_birth' => '01.01.1973',
            'contract_start_date' => '01.04.2000',
            'special_contract_days' => null,
        ]);

        $result = $this->vacationDayCalculator->calculate($employee, 2000);

        $this->assertEquals(19, $result);
    }

    /** @test */
    public function can_have_vacation_days_for_3_months_of_employment()
    {
        $employee = new Employee([
            'name' => 'Test',
            'date_of_birth' => '01.01.1973',
            'contract_start_date' => '01.10.2000',
            'special_contract_days' => null,
        ]);

        $result = $this->vacationDayCalculator->calculate($employee, 2000);

        $this->assertEquals(6, $result);
    }


    /** @test */
    public function can_not_calculate_vacation_days_for_year_before_contract()
    {
        $employee = new Employee([
            'name' => 'Test',
            'date_of_birth' => '01.01.1971',
            'contract_start_date' => '01.01.2000',
            'special_contract_days' => null,
        ]);

        $result = $this->vacationDayCalculator->calculate($employee, 1999);

        $this->assertEquals(0, $result);
    }
}
