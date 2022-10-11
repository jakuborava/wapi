<?php

namespace Jakuborava\WedosAPI\Responses;

use Jakuborava\WedosAPI\BaseResponse;
use Jakuborava\WedosAPI\Contracts\ResponseWithData;

class DomainRenewResponse implements ResponseWithData
{
    protected string $expiration = '';

    public static function fromWedosClientResponse(BaseResponse $baseResponse): DomainRenewResponse
    {
        $response = new self();
        $response->expiration = $baseResponse->getData()['expiration'];
        return $response;
    }

    public function getExpiration(): string
    {
        return $this->expiration;
    }


}
