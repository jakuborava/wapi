<?php

namespace Jakuborava\WedosAPI\Endpoints;

use Jakuborava\WedosAPI\DataTransferObjects\CreditInfo;
use Jakuborava\WedosAPI\WedosRequest;

class Credit
{
    public function info(): CreditInfo
    {
        $response = (new WedosRequest('credit-info'))->send();
        return CreditInfo::fromWedosResponseData($response->getData());
    }
}
