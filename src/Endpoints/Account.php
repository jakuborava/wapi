<?php

namespace Jakuborava\WedosAPI\Endpoints;

use Jakuborava\WedosAPI\DataTransferObjects\AccountListItem;
use Jakuborava\WedosAPI\WedosRequest;

class Account
{
    public function list(string $from, string $to): array
    {
        $response = (new WedosRequest('account-list', ['date_from' => $from, 'date_to' => $to]))->send();
        $accountListItems = [];
        foreach ($response->getData() as $accountListItemData) {
            $accountListItems[] = AccountListItem::fromWedosResponseData($accountListItemData);
        }
        return $accountListItems;
    }
}
