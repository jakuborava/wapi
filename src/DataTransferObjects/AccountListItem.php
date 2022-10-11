<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Jakuborava\WedosAPI\Contracts\DTO;

class AccountListItem implements DTO
{
    protected int $id;
    protected string $type;
    protected string $num;
    protected string $description;
    protected float $amount;
    protected ?string $billNum;
    protected ?string $billDate;
    protected bool $blocked;
    protected string $createdDate;

    public static function fromWedosResponseData(array $data): AccountListItem
    {
        $accountListItem = new self();
        $accountListItem->fill($data);
        return $accountListItem;
    }

    private function fill(array $data): void
    {
        $this->id = $data['ID'];
        $this->type = $data['type'];
        $this->num = $data['num'];
        $this->description = $data['description'];
        $this->amount = $data['amount'];
        $this->billNum = $data['bill_num'];
        $this->billDate = $data['bill_date'];
        $this->blocked = $data['blocked'];
        $this->createdDate = $data['created_date'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getNum(): string
    {
        return $this->num;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getBillNum(): ?string
    {
        return $this->billNum;
    }

    public function getBillDate(): ?string
    {
        return $this->billDate;
    }

    public function isBlocked(): bool
    {
        return $this->blocked;
    }

    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }
}
