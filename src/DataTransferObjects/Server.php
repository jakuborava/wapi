<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Jakuborava\WedosAPI\Contracts\DTO;

class Server implements DTO
{
    protected string $name = '';

    protected string $ipv4 = '';

    protected string $ipv6 = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getIpv4(): string
    {
        return $this->ipv4;
    }

    public function setIpv4(string $ipv4): void
    {
        $this->ipv4 = $ipv4;
    }

    public function getIpv6(): string
    {
        return $this->ipv6;
    }

    public function setIpv6(string $ipv6): void
    {
        $this->ipv6 = $ipv6;
    }

    public static function fromWedosResponseData(array $data): Server
    {
        $server = new self();
        $server->name = $data['name'];
        $server->ipv4 = $data['addr_ipv4'];
        $server->ipv6 = $data['addr_ipv6'];

        return $server;
    }
}
