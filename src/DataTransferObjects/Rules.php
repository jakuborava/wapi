<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Jakuborava\WedosAPI\Contracts\DTO;

readonly class Rules implements DTO
{
    public function __construct(public string $firstName, public string $lastName)
    {
    }

    public static function fromWedosResponseData(array $data): Rules
    {
        return new Rules($data['fname'], $data['lname']);
    }
}
