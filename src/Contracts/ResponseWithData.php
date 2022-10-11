<?php

namespace Jakuborava\WedosAPI\Contracts;

use Jakuborava\WedosAPI\BaseResponse;

interface ResponseWithData
{
    public static function fromWedosClientResponse(BaseResponse $baseResponse): ResponseWithData;
}
