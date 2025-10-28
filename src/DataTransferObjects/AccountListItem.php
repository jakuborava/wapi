<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Jakuborava\WedosAPI\Contracts\DTO;

readonly class AccountListItem implements DTO
{
    public function __construct(
        public int $id,
        public string $type,
        public string $num,
        public string $description,
        public float $amount,
        public ?string $billNum,
        public ?string $billDate,
        public bool $blocked,
        public string $createdDate
    ) {}

    public static function fromWedosResponseData(array $data): AccountListItem
    {
        return new AccountListItem(
            $data['ID'],
            $data['type'],
            $data['num'],
            $data['description'],
            $data['amount'],
            $data['bill_num'],
            $data['bill_date'],
            $data['blocked'],
            $data['created_date'],
        );
    }
}
