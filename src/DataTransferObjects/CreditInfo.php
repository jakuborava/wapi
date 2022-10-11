<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Jakuborava\WedosAPI\Contracts\DTO;

class CreditInfo implements DTO
{
    protected float $amount;
    protected string $currency;

    public static function fromWedosResponseData(array $data): CreditInfo
    {
        $credit = new self();
        $credit->amount = $data['amount'];
        $credit->currency = $data['currency'];
        return $credit;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}
