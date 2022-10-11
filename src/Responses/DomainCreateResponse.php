<?php

namespace Jakuborava\WedosAPI\Responses;

use Jakuborava\WedosAPI\BaseResponse;
use Jakuborava\WedosAPI\Contracts\ResponseWithData;
use Jakuborava\WedosAPI\DataTransferObjects\CreditInfo;

class DomainCreateResponse implements ResponseWithData
{
    protected string $num = '';
    protected string $expiration = '';
    protected CreditInfo $credit;

    public static function fromWedosClientResponse(BaseResponse $baseResponse): DomainCreateResponse
    {
        $response = new self();
        $response->expiration = $baseResponse->getData()['expiration'];
        $response->num = $baseResponse->getData()['num'];
        $response->credit = CreditInfo::fromWedosResponseData($baseResponse->getData()['credit']);
        return $response;
    }

    public function getNum(): string
    {
        return $this->num;
    }

    public function getExpiration(): string
    {
        return $this->expiration;
    }

    public function getCredit(): CreditInfo
    {
        return $this->credit;
    }
}
