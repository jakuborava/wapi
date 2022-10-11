<?php

namespace Jakuborava\WedosAPI;

use Illuminate\Http\Client\Response;

class BaseResponse
{
    protected int $code;
    protected string $result;
    protected int $timestamp;
    protected string $svTRID;
    protected string $command;
    protected array $data;

    public static function fromLaravelResponse(Response $response): self
    {
        $wedosResponse = new self();
        $wedosResponse->fill($response->json('response'));
        return $wedosResponse;
    }

    private function fill(array $data): void
    {
        $this->code = $data['code'];
        $this->result = $data['result'];
        $this->timestamp = $data['timestamp'];
        $this->svTRID = $data['svTRID'];
        $this->command = $data['command'] ?? '';
        $this->data = $data['data'] ?? [];
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getResult(): string
    {
        return $this->result;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getSvTRID(): string
    {
        return $this->svTRID;
    }

    public function getCommand(): string
    {
        return $this->command;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
