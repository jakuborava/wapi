<?php

namespace Jakuborava\WedosAPI\Endpoints;

use Jakuborava\WedosAPI\WedosRequest;

class Ping
{
    public function ping(): bool
    {
        (new WedosRequest('ping'))->send();

        return true;
    }

    public function pingAsync()
    {
        //TODO: implement
    }
}
