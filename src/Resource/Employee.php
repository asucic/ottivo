<?php declare(strict_types = 1);

namespace App\Resource;

use DateTime;

class Employee
{
    private $name;
    private $dateOfBirth;
    private $dateOfContract;
    private $contractDays;

    public function __construct(string $name, DateTime $dateOfBirth, DateTime $dateOfContract, ?int $contractDays)
    {
        $this->name = $name;
        $this->dateOfBirth = $dateOfBirth;
        $this->dateOfContract = $dateOfContract;
        $this->contractDays = $contractDays;
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
