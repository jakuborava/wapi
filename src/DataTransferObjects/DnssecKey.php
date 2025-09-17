<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Jakuborava\WedosAPI\Contracts\DTO;

readonly class DnssecKey implements DTO
{
    public function __construct(
        public ?string $keyTag,
        public string $key,
        public string $alg,
        public string $flag,
        public string $protocol,
        public ?string $handle,
        public ?string $digest,
        public ?string $digestAlg,
        public ?string $digestType
    ) {
    }

    public static function fromWedosResponseData(array $data): DnssecKey
    {
        return new DnssecKey(
            $data['key_tag'],
            $data['key'],
            $data['alg'],
            $data['flag'],
            $data['protocol'],
            $data['handle'],
            $data['digest'],
            $data['digest_alg'],
            $data['digest_type']
        );
    }
}
