<?php

namespace RahulGodiyal\PhpUpsApiWrapper;

use RahulGodiyal\PhpUpsApiWrapper\Auth;
use RahulGodiyal\PhpUpsApiWrapper\Entity\ValidateAddressQuery;
use RahulGodiyal\PhpUpsApiWrapper\Utils\HttpClient;

class ValidateAddress extends Auth
{
    private const REQUEST_OPTION = "3";
    private const VERSION = "v2";

    private ValidateAddressQuery $query;
    private array $addressLines = [];
    private ?string $politicalDivision2;
    private ?string $politicalDivision1;
    private ?string $postcodePrimaryLow;
    private ?string $countryCode;
    private object $apiResponse;

    public function __construct()
    {
        $this->query = new ValidateAddressQuery();
    }

    public function setQuery(ValidateAddressQuery $query): self
    {
        $this->query = $query;
        return $this;
    }

    public function setAddressLines(array $addressLines): self
    {
        $this->addressLines = $addressLines;
        return $this;
    }

    public function setPoliticalDivision1(string $politicalDivision1): self
    {
        $this->politicalDivision1 = $politicalDivision1;
        return $this;
    }

    public function setPoliticalDivision2(string $politicalDivision2): self
    {
        $this->politicalDivision2 = $politicalDivision2;
        return $this;
    }

    public function setPostcodePrimaryLow(string $postcodePrimaryLow): self
    {
        $this->postcodePrimaryLow = $postcodePrimaryLow;
        return $this;
    }

    public function setCountryCode(string $country_code): self
    {
        $this->countryCode = $country_code;
        return $this;
    }

    public function validate(string $client_id, string $client_secret): array
    {
        $auth = $this->authenticate($client_id, $client_secret);

        if ($auth['status'] == 'fail') {
            return $auth;
        }

        $access_token = $auth['access_token'];

        $queryParams = "";
        if ($this->query->exists()) {
            $queryParams = "?" . http_build_query($this->query->toArray());
        }

        $httpClient = new HttpClient();
        $httpClient->setHeader([
            "Authorization: Bearer $access_token",
            "Content-Type: application/json"
        ]);
        $httpClient->setPayload($this->getRequest());
        $httpClient->setUrl($this->_getAPIBaseURL() . "/api/addressvalidation/" . self::VERSION . "/" . self::REQUEST_OPTION . $queryParams);
        $httpClient->setMethod("POST");
        $this->apiResponse = $res = $httpClient->fetch();
        
        if (!isset($res->XAVResponse)) {
            if (isset($res->response)) {
                $error = $res->response->errors[0]->message;
            } else {
                $error = "Address Validation Failed! Please try again.";
            }
            return ['status' => 'fail', 'msg' => $error];
        }

        if (!isset($res->XAVResponse->Candidate)) {
            return ['status' => 'fail', 'msg' => "Invalid Address."];
        }

        $addresses = $this->getAddresses($res->XAVResponse->Candidate);

        $return_res = ['status' => 'success', 'addresses' => $addresses];
        if (isset($res->XAVResponse->AddressClassification)) {
            $return_res['address_classification'] = $res->XAVResponse->AddressClassification;
        }

        return $return_res;
    }

    public function getRequest(): string
    {
        return json_encode([
            "XAVRequest" => [
                "AddressKeyFormat" => [
                    "AddressLine" => $this->addressLines,
                    "PoliticalDivision2" => $this->politicalDivision2,
                    "PoliticalDivision1" => $this->politicalDivision1,
                    "PostcodePrimaryLow" => $this->postcodePrimaryLow,
                    "CountryCode" => $this->countryCode
                ]
            ]
        ]);
    }

    private function getAddresses(array $candidates): array
    {
        $addresses = [];
        foreach ($candidates as $candObj) {
            $addressObj = $candObj->AddressKeyFormat;
            $address = [
                'address_line' => $addressObj->AddressLine,
                'city' => $addressObj->PoliticalDivision2,
                'state' => $addressObj->PoliticalDivision1,
                'zipcode' => $addressObj->PostcodePrimaryLow,
                'region' => $addressObj->Region,
                'country' => $addressObj->CountryCode
            ];
            $address['address_classification'] = $candObj->AddressClassification;
            array_push($addresses, $address);
        }

        return $addresses;
    }

    public function setMode(string $mode): self
    {
        parent::setMode($mode);
        return $this;
    }
    
    public function getResponse(): string
    {
        return json_encode($this->apiResponse);
    }
}
