<?php

namespace Jakuborava\WedosAPI\DataTransferObjects\NullObjects;

use Jakuborava\WedosAPI\DataTransferObjects\DNSRow;

class DNSRowNullObject extends DNSRow
{
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = -1;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = null;
    }

    public function getTtl(): int
    {
        return $this->ttl;
    }

    public function setTtl(int $ttl): void
    {
        $this->ttl = -1;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = '';
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data): void
    {
        $this->data = '';
    }

    public function getChangedDate(): string
    {
        return $this->changedDate;
    }

    public function setChangedDate(string $changedDate): void
    {
        $this->changedDate = '';
    }

    public function getAuthorComment(): string
    {
        return $this->authorComment;
    }

    public function setAuthorComment(string $authorComment): void
    {
        $this->authorComment = '';
    }
}
