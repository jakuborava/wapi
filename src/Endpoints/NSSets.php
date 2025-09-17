<?php

namespace Jakuborava\WedosAPI\Endpoints;

use Illuminate\Http\Client\HttpClientException;
use Illuminate\Support\Str;
use Jakuborava\WedosAPI\BaseResponse;
use Jakuborava\WedosAPI\DataTransferObjects\DNS;
use Jakuborava\WedosAPI\DataTransferObjects\NsSet;
use Jakuborava\WedosAPI\Exceptions\RequestFailedException;
use Jakuborava\WedosAPI\Utils\DnsUtils;
use Jakuborava\WedosAPI\WedosRequest;

class NSSets
{
    /**
     * @throws HttpClientException
     * @throws RequestFailedException
     */
    public function check(string $tld, string $name): bool
    {
        try {
            (new WedosRequest('nsset-check', ['tld' => $tld, 'name' => $name]))->send();
        } catch (RequestFailedException $exception) {
            if (Str::contains($exception->getMessage(), 'Response code: 32')) {
                return false;
            }
            throw $exception;
        }

        return true;
    }

    public function info(string $tld, string $name): NsSet
    {
        $response = (new WedosRequest('nsset-info', ['tld' => $tld, 'name' => $name]))->send();

        return NsSet::fromWedosResponseData($response->getData()['nsset']);
    }

    public function create(string $tld, string $name, DNS $dns, ?string $technicalContact = null): BaseResponse
    {
        $body = [];

        $body['tld'] = $tld;
        $body['name'] = $name;
        $body['dns'] = DnsUtils::getDNSBody($dns);

        if (! blank($technicalContact)) {
            $body['tech_c'] = $technicalContact;
        }

        return (new WedosRequest('nsset-create', $body))->send();
    }

    public function update()
    {
        // TODO: implement
    }

    public function transfer()
    {
        // TODO: implement
    }

    public function sendAuthInfo()
    {
        // TODO: implement
    }
}
