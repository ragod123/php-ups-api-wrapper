<?php

namespace RahulGodiyal\PhpUpsApiWrapper;

use RahulGodiyal\PhpUpsApiWrapper\Auth;
use RahulGodiyal\PhpUpsApiWrapper\Utils\HttpClient;

class AddressValidation extends Auth
{
    private const REQUEST_OPTION = "3";
    private const VERSION = "v2";

    private static array $address;
    private array $query = [
        "regionalrequestindicator" => "string",
        "maximumcandidatelistsize" => "1"
    ];

    public static function setAddress(array $address): self
    {
        self::$address = $address;
        return new self;
    }

    public function validate(string $client_id, string $client_secret): array
    {
        $auth = $this->authenticate($client_id, $client_secret);

        if ($auth['status'] == 'fail') {
            return $auth;
        }

        $access_token = $auth['access_token'];
        
        $httpClient = new HttpClient();
        $httpClient->setHeader([
            "Authorization: Bearer $access_token",
            "Content-Type: application/json"
        ]);
        $httpClient->setPayload(json_encode($this->getPayLoad()));
        $httpClient->setUrl($this->_getAPIBaseURL() . "/api/addressvalidation/" . self::VERSION . "/" . self::REQUEST_OPTION . "?" . http_build_query($this->query));
        $httpClient->setMethod("POST");
        $res = $httpClient->fetch();
        
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
        return ['status' => 'success', 'addresses' => $addresses];
    }

    private function getPayLoad(): array
    {
        return [
            "XAVRequest" => [
                "AddressKeyFormat" => self::$address
            ]
        ];
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
            array_push($addresses, $address);
        }

        return $addresses;
    }
    
    public function setMode(string $mode): self
    {
        parent::setMode($mode);
        return $this;
    }
}
