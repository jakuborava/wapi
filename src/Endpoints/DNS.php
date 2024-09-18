<?php

namespace Jakuborava\WedosAPI\Endpoints;

use Jakuborava\WedosAPI\Endpoints\DNS\Domain;
use Jakuborava\WedosAPI\Endpoints\DNS\Row;

class DNS
{
    public function domain(): Domain
    {
        return new Domain;
    }

    public function row(): Row
    {
        return new Row;
    }
}
