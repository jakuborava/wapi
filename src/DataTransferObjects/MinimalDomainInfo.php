<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Jakuborava\WedosAPI\Contracts\DTO;
use JsonSerializable;

readonly class MinimalDomainInfo implements DTO, JsonSerializable
{
    public function __construct(public string $name, public string $status, public ?string $expiration)
    {
    }

    public static function fromWedosResponseData(array $data): MinimalDomainInfo
    {
        return new MinimalDomainInfo($data['name'], $data['status'], $data['expiration']);
    }

    public function jsonSerialize(): array
    {
        return ['name' => $this->name, 'status' => $this->status, 'expiration' => $this->expiration];
    }
}
