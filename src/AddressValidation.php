<?php

namespace RahulGodiyal\PhpUpsApiWrapper;

use RahulGodiyal\PhpUpsApiWrapper\Auth;

class AddressValidation extends Auth
{
    private static $_address;
    private $_request_option;
    private $_version;
    private $_query;

    public function __construct()
    {
        parent::__construct();
        $this->_request_option = "3";
        $this->_version = "v2";
        $this->_query = [
            "regionalrequestindicator" => "string",
            "maximumcandidatelistsize" => "1"
        ];
    }

    /**
     * Set Address to validate
     * @param array $address
     * @return self
     */
    public static function setAddress(array $address)
    {
        self::$_address = $address;
        return new self;
    }

    /**
     * Validate the address
     * @param string $client_id
     * @param string $client_secret
     * @return array of validated address
     */
    public function validate(String $client_id, String $client_secret)
    {
        $auth = $this->authenticate($client_id, $client_secret);

        if ($auth['status'] == 'fail') {
            return $auth;
        }

        $access_token = $auth['access_token'];
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer $access_token",
                "Content-Type: application/json"
            ],
            CURLOPT_POSTFIELDS => json_encode($this->_payload()),
            CURLOPT_URL => $this->_getAPIBaseURL() . "/api/addressvalidation/" . $this->_version . "/" . $this->_request_option . "?" . http_build_query($this->_query),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($response);

        if (!isset($res->XAVResponse)) {
            $error = $res->response->errors[0]->message;
            return ['status' => 'fail', 'msg' => $error];
        }

        $addresses = $this->_getAddresses($res->XAVResponse->Candidate);
        return ['status' => 'success', 'addresses' => $addresses];
    }

    /**
     * Get Payload
     * @return array $payload
     */
    private function _payload()
    {
        return [
            "XAVRequest" => [
                "AddressKeyFormat" => self::$_address
            ]
        ];
    }

    /**
     * Get Addresses
     * @param array of objects
     * @return array of addresses
     */
    private function _getAddresses(Array $candidates)
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
}
