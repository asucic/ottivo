<?php declare(strict_types = 1);

namespace App\Factory;

use App\Resource\Employee;
use DateTime;

class EmployeeFactory
{
    public static function create(array $data): Employee
    {
        return new Employee(
            $data['name'],
            DateTime::createFromFormat('d.m.Y' ,$data['date_of_birth']),
            DateTime::createFromFormat('d.m.Y' ,$data['contract_start_date']),
            $data['special_contract_days']
        );
    }

    /** Should be used primarily for testing purposes */
    public static function createWithDefaults(array $data = []): Employee
    {
        return new Employee(
            $data['name'] ?? 'Dummy',
            DateTime::createFromFormat('d.m.Y' ,$data['date_of_birth'] ?? '01.01.1990'),
            DateTime::createFromFormat('d.m.Y' ,$data['contract_start_date'] ?? '01.01.2000'),
            $data['special_contract_days'] ?? null
        );
    }
}
