<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Illuminate\Support\Collection;
use Jakuborava\WedosAPI\Contracts\DTO;

readonly class DNS implements DTO
{
    public function __construct(public Collection $servers)
    {
    }

    public static function fromWedosResponseData(array $data): DNS
    {
        $servers = new Collection();

        foreach ($data as $serverData) {
            $servers->add(Server::fromWedosResponseData($serverData));
        }

        return new DNS($servers);
    }
}
