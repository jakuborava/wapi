<?php

namespace Jakuborava\WedosAPI\Contracts;

interface DTO
{
    public static function fromWedosResponseData(array $data): DTO;
}
