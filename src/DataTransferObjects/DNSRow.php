<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Jakuborava\WedosAPI\Contracts\DTO;

readonly class DNSRow implements DTO
{
    public function __construct(
        public int $id = -1,
        public ?string $name = null,
        public int $ttl = -1,
        public string $type = '',
        public string $data = '',
        public string $changedDate = '',
        public string $authorComment = ''
    ) {}

    public static function fromWedosResponseData(array $data): DNSRow
    {
        return new DNSRow(
            $data['ID'],
            $data['name'],
            $data['ttl'],
            $data['rdtype'],
            $data['rdata'],
            $data['changed_date'],
            $data['author_comment']
        );
    }
}
