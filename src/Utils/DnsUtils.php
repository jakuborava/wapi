<?php

namespace Jakuborava\WedosAPI\Utils;

use Jakuborava\WedosAPI\DataTransferObjects\DNS;

class DnsUtils
{
    public static function getDNSBody(?DNS $dns): array
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
