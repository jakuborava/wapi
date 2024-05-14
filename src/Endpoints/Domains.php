<?php

namespace Jakuborava\WedosAPI\Endpoints;

use Carbon\Carbon;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Support\Collection;
use Jakuborava\WedosAPI\DataTransferObjects\DNS;
use Jakuborava\WedosAPI\DataTransferObjects\FullDomainInfo;
use Jakuborava\WedosAPI\DataTransferObjects\MinimalDomainInfo;
use Jakuborava\WedosAPI\DataTransferObjects\Rules;
use Jakuborava\WedosAPI\Exceptions\RequestFailedException;
use Jakuborava\WedosAPI\Responses\DomainCreateResponse;
use Jakuborava\WedosAPI\Responses\DomainRenewResponse;
use Jakuborava\WedosAPI\WedosRequest;

class Domains
{
    /**
     * @throws RequestFailedException
     * @throws HttpClientException
     */
    public function info(string $name): FullDomainInfo
    {
        $response = (new WedosRequest('domain-info', ['name' => $name]))->send();

        return FullDomainInfo::fromWedosResponseData($response->getData()['domain']);
    }

    /**
     * @throws RequestFailedException
     * @throws HttpClientException
     */
    public function list(): array
    {
        $response = (new WedosRequest('domains-list'))->send();
        $domains = [];
        foreach ($response->getData()['domain'] as $domain) {
            $domains[] = MinimalDomainInfo::fromWedosResponseData($domain);
        }

        return $domains;
    }

    /**
     * @throws RequestFailedException
     * @throws HttpClientException
     */
    public function renew(string $name, int $period): DomainRenewResponse
    {
        $response = (new WedosRequest('domain-renew', ['name' => $name, 'period' => $period]))->send();

        return DomainRenewResponse::fromWedosClientResponse($response);
    }

    public function transfer()
    {
        //TODO: implement
    }

    public function updateNS(string $domainName, ?DNS $dns = null, string $nsset = ''): DomainRenewResponse
    {
        $data = ['name' => $domainName];

        if ($dns !== null) {
            $data['dns'] = $this->getDNSBody($dns);
        }

        if(!blank($nsset)) {
            $data['nsset'] = $nsset;
        }

        $response = (new WedosRequest('domain-update-ns', $data))->send();

        return DomainRenewResponse::fromWedosClientResponse($response);
    }

    public function sendAuthInfo()
    {
        //TODO: implement
    }

    public function tldPeriodCheck()
    {
        //TODO: implement
    }

    public function transferCheck()
    {
        //TODO: implement
    }

    /**
     * @throws HttpClientException
     * @throws RequestFailedException
     */
    public function create(
        string $name,
        int $period,
        string $adminContact,
        string $ownerContact,
        Rules $rules,
        string $nsset = '',
        ?DNS $dns = null
    ): DomainCreateResponse {
        $response = (new WedosRequest(
            'domain-create',
            $this->getDomainCreateRequestBody($name, $period, $ownerContact, $adminContact, $rules, $nsset, $dns)
        ))->send();

        return DomainCreateResponse::fromWedosClientResponse($response);
    }

    public function check(string $name): bool
    {
        (new WedosRequest('domain-check', ['name' => $name]))->send();

        return true;
    }

    public function updateKeySet()
    {
        //TODO: implement
    }

    private function getDomainCreateRequestBody(
        string $name,
        int $period,
        string $ownerContact,
        string $adminContact,
        Rules $rules,
        string $nsset,
        ?DNS $dns
    ): array {
        $body = [
            'name' => $name,
            'period' => $period,
            'owner_c' => $ownerContact,
            'admin_c' => $adminContact,
            'rules' => [
                'fname' => $rules->getFName(),
                'lname' => $rules->getLName(),
            ],
        ];

        if (! blank($nsset)) {
            $body['nsset'] = $nsset;
        } else {
            $body['dns'] = $this->getDNSBody($dns);
        }

        return $body;
    }

    /**
     * @throws HttpClientException
     * @throws RequestFailedException
     */
    public function expired(): Collection
    {
        return collect($this->list())->filter(
            function (MinimalDomainInfo $domainInfo) {
                return $domainInfo->getStatus() === 'expired';
            }
        )->values();
    }

    /**
     * @throws HttpClientException
     * @throws RequestFailedException
     */
    public function expiringIn(int $days): Collection
    {
        return collect($this->list())->filter(
            function (MinimalDomainInfo $domainInfo) use ($days) {
                return Carbon::parse($domainInfo->getExpiration())->diffInDays(now()) <= $days &&
                    $domainInfo->getStatus() === 'active';
            }
        )->sort(function (MinimalDomainInfo $a, MinimalDomainInfo $b) {
            $aExpiration = Carbon::parse($a->getExpiration());
            $bExpiration = Carbon::parse($b->getExpiration());

            if ($aExpiration->eq($bExpiration)) {
                return 0;
            }

            return ($aExpiration->gt($bExpiration)) ? 1 : -1;
        })->values();
    }

    private function getDNSBody(?DNS $dns): array
    {
        $servers = [];
        if (! is_null($dns)) {
            $counter = 1;
            foreach ($dns->getServers() as $server) {
                $servers['server'.$counter++] = ['name' => $server->getName()];
            }
        }

        return $servers;
    }
}
