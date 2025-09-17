<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Jakuborava\WedosAPI\Contracts\DTO;

readonly class CreditInfo implements DTO
{
    public function __construct(public float $amount, public string $currency)
    {
    }

    public static function fromWedosResponseData(array $data): CreditInfo
    {
        return new CreditInfo($data['amount'], $data['currency']);
    }
}
