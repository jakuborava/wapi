<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Jakuborava\WedosAPI\Contracts\DTO;

class DNS implements DTO
{
    protected array $servers = [];

    public function getServers(): array
    {
        return $this->servers;
    }

    public function setServers(array $servers): void
    {
        $this->servers = $servers;
    }

    public static function fromWedosResponseData(array $data): DNS
    {
        $dns = new self();
        foreach ($data['servers'] as $serverData) {
            $dns->servers[] = Server::fromWedosResponseData($serverData);
        }

        return $dns;
    }
}
