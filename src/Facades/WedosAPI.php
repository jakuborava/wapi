<?php

namespace Jakuborava\WedosAPI\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Jakuborava\WedosAPI\WedosAPI
 */
class WedosAPI extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Jakuborava\WedosAPI\WedosAPI::class;
    }
}
