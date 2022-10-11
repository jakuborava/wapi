<?php

namespace Jakuborava\WedosAPI\Endpoints\DNS;

use Jakuborava\WedosAPI\Exceptions\RequestFailedException;
use Jakuborava\WedosAPI\DataTransferObjects\DNSRow;
use Jakuborava\WedosAPI\WedosRequest;
use Illuminate\Http\Client\HttpClientException;

class Row
{
    /**
     * @throws HttpClientException
     * @throws RequestFailedException
     */
    public function add(string $domain, string $name, int $ttl, string $type, string $rdata): void
    {
        (new WedosRequest(
            'dns-row-add',
            [
                'domain' => $domain,
                'name' => $name,
                'ttl' => $ttl,
                'type' => $type,
                'rdata' => $rdata
            ]
        ))->send();
    }

    /**
     * @throws RequestFailedException
     * @throws HttpClientException
     */
    public function delete(string $domain, int $rowID): void
    {
        (new WedosRequest(
            'dns-row-delete',
            ['domain' => $domain, 'row_id' => $rowID]
        ))->send();
    }

    /**
     * @throws RequestFailedException
     * @throws HttpClientException
     */
    public function detail(string $domain, int $rowID): DNSRow
    {
        $response = (new WedosRequest(
            'dns-row-detail',
            ['domain' => $domain, 'row_id' => $rowID]
        ))->send();
        return DNSRow::fromWedosResponseData($response->getData()['row']);
    }

    /**
     * @throws RequestFailedException
     * @throws HttpClientException
     */
    public function list(string $domainName): array
    {
        $response = (new WedosRequest('dns-rows-list', ['domain' => $domainName]))->send();
        $rows = [];
        foreach ($response->getData()['row'] as $row) {
            $rows[] = DNSRow::fromWedosResponseData($row);
        }
        return $rows;
    }

    /**
     * @throws HttpClientException
     * @throws RequestFailedException
     */
    public function update(string $domain, int $rowID, int $ttl, string $rData): void
    {
        (new WedosRequest(
            'dns-row-update',
            [
                'domain' => $domain,
                'row_id' => $rowID,
                'ttl' => $ttl,
                'rdata' => $rData
            ]
        ))->send();
    }
}
