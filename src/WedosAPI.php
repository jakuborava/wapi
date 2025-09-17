<?php

namespace Jakuborava\WedosAPI;

use Jakuborava\WedosAPI\Endpoints\Account;
use Jakuborava\WedosAPI\Endpoints\Contacts;
use Jakuborava\WedosAPI\Endpoints\Credit;
use Jakuborava\WedosAPI\Endpoints\DNS;
use Jakuborava\WedosAPI\Endpoints\Domains;
use Jakuborava\WedosAPI\Endpoints\NSSets;
use Jakuborava\WedosAPI\Endpoints\Ping;
use Jakuborava\WedosAPI\Endpoints\Poll;

class WedosAPI
{
    public function dns(): DNS
    {
        return new DNS;
    }

    public function credit(): Credit
    {
        return new Credit;
    }

    public function ping(): Ping
    {
        return new Ping;
    }

    public function account(): Account
    {
        return new Account;
    }

    public function nsSets(): NSSets
    {
        return new NSSets;
    }

    public function contact(): Contacts
    {
        return new Contacts;
    }

    public function domains(): Domains
    {
        return new Domains;
    }

    public function poll(): Poll
    {
        return new Poll;
    }
}
