<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Carbon\Carbon;

readonly class NsSet
{
    public function __construct(
        public string $name,
        public string $status,
        public string $regOwner,
        public string $regCreator,
        public string $regUpdate,
        public Carbon $createdDate,
        public Carbon $updatedDate,
        public Carbon $transferDate,
        public string $techContact,
        public DNS $dns
    ) {
    }

    public static function fromWedosResponseData(array $data): NsSet
    {
        return new NsSet(
            $data['name'],
            $data['status'],
            $data['reg_owner'],
            $data['reg_creator'],
            $data['reg_update'],
            Carbon::parse($data['created_date']),
            Carbon::parse($data['updated_date']),
            Carbon::parse($data['transfer_date']),
            $data['tech_c'],
            DNS::fromWedosResponseData($data['dns']['server'])
        );
    }
}
