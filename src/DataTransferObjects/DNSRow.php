<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Jakuborava\WedosAPI\Contracts\DTO;

class DNSRow implements DTO
{
    protected int $id = -1;

    protected ?string $name = null;

    protected int $ttl = -1;

    protected string $type = '';

    protected string $data = '';

    protected string $changedDate = '';

    protected string $authorComment = '';

    public static function fromWedosResponseData(array $data): DNSRow
    {
        $dnsRow = new self;
        $dnsRow->id = $data['ID'];
        $dnsRow->name = $data['name'];
        $dnsRow->ttl = $data['ttl'];
        $dnsRow->type = $data['rdtype'];
        $dnsRow->data = $data['rdata'];
        $dnsRow->changedDate = $data['changed_date'];
        $dnsRow->authorComment = $data['author_comment'];

        return $dnsRow;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getTtl(): int
    {
        return $this->ttl;
    }

    public function setTtl(int $ttl): void
    {
        $this->ttl = $ttl;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data): void
    {
        $this->data = $data;
    }

    public function getChangedDate(): string
    {
        return $this->changedDate;
    }

    public function setChangedDate(string $changedDate): void
    {
        $this->changedDate = $changedDate;
    }

    public function getAuthorComment(): string
    {
        return $this->authorComment;
    }

    public function setAuthorComment(string $authorComment): void
    {
        $this->authorComment = $authorComment;
    }
}
