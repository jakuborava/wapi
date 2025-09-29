<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

use Illuminate\Support\Collection;

readonly class FullDomainInfo extends MinimalDomainInfo
{
    public function __construct(
        public string $name,
        public string $status,
        public ?string $expiration,
        public ?string $nsset,
        public ?string $keySet,
        public string $ownerContact,
        public string $adminContact,
        public string $technicalContact,
        public string $billingContact,
        public string $regOwner,
        public string $regCreator,
        public string $setupDate,
        public string $regUpdate,
        public string $updatedDate,
        public string $transferDate,
        public DNS $dns,
        /** @var Collection<int, DnssecKey> $dnssecKeys */
        public ?Collection $dnssecKeys,
        public string $ownerCompany,
        public string $ownerName,
        public string $ownerLastName,
        public string $ownerFirstName,
        public string $ownerEmail,
        public ?string $ownerEmail2,
        public string $ownerPhone,
        public string $ownerFax,
        public ?string $ownerIC,
        public ?string $ownerDIC,
        public ?string $ownerTaxpayer,
        public string $ownerAddressStreet,
        public string $ownerAddressCity,
        public string $ownerAddressZip,
        public string $ownerAddressCountry,
        public string $ownerAddressState,
        public ?string $rgpStatus,
        public string $ownerNotifyEmail,
        public string $ownerIdentType,
        public string $ownerIdent,
        public string $ownerDeliveryAddress,
    ) {}

    public static function fromWedosResponseData(array $data): FullDomainInfo
    {
        return new FullDomainInfo(
            $data['name'],
            $data['status'],
            $data['expiration'],
            $data['nsset'],
            $data['keyset'],
            $data['owner_c'],
            $data['admin_c'],
            $data['tech_c'],
            $data['billing_c'],
            $data['reg_owner'],
            $data['reg_creator'],
            $data['setup_date'],
            $data['reg_update'],
            $data['updated_date'],
            $data['transfer_date'],
            DNS::fromWedosResponseData($data['dns']['server']),
            isset($data['dnssec_keys']) ? self::collectDnssecKeys($data['dnssec_keys']) : new Collection,
            $data['own_company'],
            $data['own_name'],
            $data['own_lname'],
            $data['own_fname'],
            $data['own_email'],
            $data['own_email2'],
            $data['own_phone'],
            $data['own_fax'],
            $data['own_ic'],
            $data['own_dic'],
            $data['own_taxpayer'],
            $data['own_addr_street'],
            $data['own_addr_city'],
            $data['own_addr_zip'],
            $data['own_addr_country'],
            $data['own_addr_state'],
            $data['rgp_status'],
            $data['own_other']['notify_email'] ?? '',
            $data['own_other']['ident_type'] ?? '',
            $data['own_other']['ident'] ?? '',
            $data['own_other']['del_addr'] ?? '',
        );
    }

    /** @return Collection<int, DnssecKey> */
    private static function collectDnssecKeys(array $dnssecKeys): Collection
    {
        return (new Collection($dnssecKeys))->map(function (array $dnssecKey) {
            return DnssecKey::fromWedosResponseData($dnssecKey);
        });
    }
}
