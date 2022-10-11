<?php

namespace Jakuborava\WedosAPI\DataTransferObjects;

class FullDomainInfo extends MinimalDomainInfo
{
    protected ?string $nsset;
    protected ?string $keySet;
    protected string $ownerContact;
    protected string $adminContact;
    protected string $technicalContact;
    protected string $billingContact;
    protected string $regOwner;
    protected string $regCreator;
    protected string $setupDate;
    protected string $regUpdate;
    protected string $updatedDate;
    protected string $transferDate;
    protected DNS $dns;
    protected ?string $dnssecKeys;
    protected string $ownerCompany;
    protected string $ownerName;
    protected string $ownerLastName;
    protected string $ownerFirstName;
    protected string $ownerEmail;
    protected ?string $ownerEmail2;
    protected string $ownerPhone;
    protected string $ownerFax;
    protected ?string $ownerIC;
    protected ?string $ownerDIC;
    protected ?string $ownerTaxpayer;
    protected string $ownerAddressStreet;
    protected string $ownerAddressCity;
    protected string $ownerAddressZip;
    protected string $ownerAddressCountry;
    protected string $ownerAddressState;
    protected ?string $rgpStatus;
    protected string $ownerNotifyEmail;
    protected string $ownerIdentType;
    protected string $ownerIdent;
    protected string $ownerDeliveryAddress;

    public static function fromWedosResponseData(array $data): FullDomainInfo
    {
        $domain = new self();
        $domain->name = $data['name'];
        $domain->status = $data['status'];
        $domain->expiration = $data['expiration'];
        $domain->nsset = $data['nsset'];
        $domain->keySet = $data['keyset'];
        $domain->ownerContact = $data['owner_c'];
        $domain->adminContact = $data['admin_c'];
        $domain->technicalContact = $data['tech_c'];
        $domain->billingContact = $data['billing_c'];
        $domain->regOwner = $data['reg_owner'];
        $domain->regCreator = $data['reg_creator'];
        $domain->setupDate = $data['setup_date'];
        $domain->regUpdate = $data['reg_update'];
        $domain->updatedDate = $data['updated_date'];
        $domain->transferDate = $data['transfer_date'];
        $dns = new DNS();
        $servers = [];
        foreach ($data['dns']['server'] as $dnsServer) {
            $server = new Server();
            $server->setName($dnsServer['name']);
            $server->setIpv4($dnsServer['addr_ipv4']);
            $server->setIpv6($dnsServer['addr_ipv6']);
            $servers[] = $server;
        }
        $dns->setServers($servers);
        $domain->dns = $dns;
        $domain->dnssecKeys = $data['dnssec_keys'];
        $domain->ownerCompany = $data['own_company'];
        $domain->ownerName = $data['own_name'];
        $domain->ownerLastName = $data['own_lname'];
        $domain->ownerFirstName = $data['own_fname'];
        $domain->ownerEmail = $data['own_email'];
        $domain->ownerEmail2 = $data['own_email2'];
        $domain->ownerPhone = $data['own_phone'];
        $domain->ownerFax = $data['own_fax'];
        $domain->ownerIC = $data['own_ic'];
        $domain->ownerDIC = $data['own_dic'];
        $domain->ownerTaxpayer = $data['own_taxpayer'];
        $domain->ownerAddressStreet = $data['own_addr_street'];
        $domain->ownerAddressCity = $data['own_addr_city'];
        $domain->ownerAddressZip = $data['own_addr_zip'];
        $domain->ownerAddressCountry = $data['own_addr_country'];
        $domain->ownerAddressState = $data['own_addr_state'];
        $domain->rgpStatus = $data['rgp_status'];
        $domain->ownerNotifyEmail = $data['own_other']['notify_email'] ?? '';
        $domain->ownerIdentType = $data['own_other']['ident_type'];
        $domain->ownerIdent = $data['own_other']['ident'];
        $domain->ownerDeliveryAddress = $data['own_other']['del_addr'] ?? '';
        return $domain;
    }
}
