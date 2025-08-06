<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Carbon\Carbon;
use Illuminate\Support\Collection;

readonly class NsSet
{
    public function __construct(
        public string $name,
        public string $status,
        public string $regOwner,
        public string $regCreator,
        public string $regUpdate,
        public Carbon $createdDate,
        public Carbon $updatedDate,
        public Carbon $transferDate,
        public string $techContact,
        public DNS $dns
    ) {
    }

    public static function fromWedosResponseData(array $data): NsSet
    {
        return new NsSet(
            $data['name'],
            $data['status'],
            $data['reg_owner'],
            $data['reg_creator'],
            $data['reg_update'],
            Carbon::parse($data['created_date']),
            Carbon::parse($data['updated_date']),
            Carbon::parse($data['transfer_date']),
            $data['tech_c'],
            self::collectDns($data['dns']['server'])
        );
    }

    private static function collectDns(array $dnsServers): DNS
    {
        $dnsServers = (new Collection($dnsServers))->map(function (array $server) {
            $dnsServer = new Server();
            $dnsServer->setName($server['name']);

            if (isset($server['addr_ipv4'][0])) {
                $dnsServer->setIpv4($server['addr_ipv4'][0]);
            }

            if (isset($server['addr_ipv6'][0])) {
                $dnsServer->setIpv4($server['addr_ipv6'][0]);
            }

            return $dnsServer;
        })->toArray();

        $dnsRecord = new DNS();
        $dnsRecord->setServers($dnsServers);

        return $dnsRecord;
    }
}
