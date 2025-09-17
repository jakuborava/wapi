<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Jakuborava\WedosAPI\Contracts\DTO;

readonly class Server implements DTO
{
    public function __construct(public string $name, public string $ipv4, public string $ipv6)
    {
    }

    public static function fromWedosResponseData(array $data): Server
    {
        return new Server($data['name'], $data['addr_ipv4'][0] ?? '', $data['addr_ipv6'][0] ?? '');
    }
}
