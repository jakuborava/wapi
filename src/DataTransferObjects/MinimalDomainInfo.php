<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Jakuborava\WedosAPI\Contracts\DTO;
use JsonSerializable;

class MinimalDomainInfo implements DTO, JsonSerializable
{
    protected string $name;

    protected string $status;

    protected ?string $expiration;

    public static function fromWedosResponseData(array $data): MinimalDomainInfo
    {
        $domain = new self;
        $domain->name = $data['name'];
        $domain->status = $data['status'];
        $domain->expiration = $data['expiration'];

        return $domain;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getExpiration(): ?string
    {
        return $this->expiration;
    }

    public function jsonSerialize(): array
    {
        return ['name' => $this->name, 'status' => $this->status, 'expiration' => $this->getExpiration()];
    }
}
