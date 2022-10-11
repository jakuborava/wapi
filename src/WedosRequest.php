<?php

namespace Jakuborava\WedosAPI;

use Jakuborava\WedosAPI\Exceptions\RequestFailedException;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class WedosRequest
{
    protected string $command;
    protected array $data;
    protected bool $handlesErrors;

    public function __construct(string $command, array $data = [])
    {
        $this->command = $command;
        $this->data = $data;
        $this->withErrorHandling();
    }

    public function withoutErrorHandling(): WedosRequest
    {
        $this->handlesErrors = false;
        return $this;
    }

    public function withErrorHandling(): WedosRequest
    {
        $this->handlesErrors = true;
        return $this;
    }

    /**
     * @throws RequestFailedException
     * @throws HttpClientException
     */
    public function send(): BaseResponse
    {
        $wedosResponse = BaseResponse::fromLaravelResponse($this->sendPost());

        if ($this->handlesErrors && $wedosResponse->getCode() !== 1000) {
            throw new RequestFailedException(
                $wedosResponse->getResult() . '. Response code: ' . $wedosResponse->getCode()
            );
        }

        return $wedosResponse;
    }

    private function getRequestBody(): string
    {
        $input = [
            'request' => [
                'user' => config('wapi.user'),
                'auth' => $this->getAuthToken(),
                'command' => $this->command
            ]
        ];
        if (!empty($this->data)) {
            $input['request']['data'] = $this->data;
        }
        return 'request=' . json_encode($input);
    }

    private function getAuthToken(): string
    {
        $date = new DateTime('now', new DateTimeZone('Europe/Prague'));
        return sha1(config('wapi.user') . sha1(config('wapi.password')) . $date->format('H'));
    }

    /**
     * @throws HttpClientException
     */
    private function sendPost(): Response
    {
        $response = Http::timeout(60)
            ->withBody($this->getRequestBody(), 'application/x-www-form-urlencoded')
            ->post(config('wapi.url'));

        if (!$response->ok()) {
            throw new HttpClientException('Response was not successful. HTTP Response code: ' . $response->status());
        }

        return $response;
    }
}
