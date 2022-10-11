<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Jakuborava\WedosAPI\Contracts\DTO;

class Rules implements DTO
{
    protected string $fName = '';
    protected string $lName = '';

    public function __construct(string $firstName, string $lastName)
    {
        $this->fName = $firstName;
        $this->lName = $lastName;
    }

    public function getFName(): string
    {
        return $this->fName;
    }

    public function getLName(): string
    {
        return $this->lName;
    }

    public static function fromWedosResponseData(array $data): Rules
    {
        return new self($data['fname'], $data['lname']);
    }
}
