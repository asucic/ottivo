<?php declare(strict_types = 1);

namespace App\Resource;

use DateTime;

class Employee
{
    private $name;
    private $dateOfBirth;
    private $dateOfContract;
    private $contractDays;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->dateOfBirth = DateTime::createFromFormat('d.m.Y', $data['date_of_birth']);
        $this->dateOfContract = DateTime::createFromFormat('d.m.Y', $data['contract_start_date']);
        $this->contractDays = $data['special_contract_days'];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDateOfBirth(): DateTime
    {
        return $this->dateOfBirth;
    }

    public function getDateOfContract(): DateTime
    {
        return $this->dateOfContract;
    }

    public function getContractDays(): ?int
    {
        return $this->contractDays;
    }
}
