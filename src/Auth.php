<?php

namespace RahulGodiyal\PhpUpsApiWrapper;

class Auth
{
    private $_mode;
    private $_dev_api_base_url;
    private $_prod_api_base_url;

    public function __construct()
    {
        $this->_mode = 'DEV';
        $this->_dev_api_base_url = 'https://wwwcie.ups.com';
        $this->_prod_api_base_url = 'https://onlinetools.ups.com';
    }

    /**
     * Authenticate User
     * @param string $client_id
     * @param string $client_secret
     * @return string $access_token
     */
    public function authenticate(String $client_id, String $client_secret)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/x-www-form-urlencoded",
                "x-merchant-id: string",
                "Authorization: Basic " . base64_encode($client_id . ":" . $client_secret)
            ],
            CURLOPT_POSTFIELDS => $this->_getPayload(),
            CURLOPT_URL => $this->_getAPIBaseURL() . "/security/v1/oauth/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($response);

        if (!isset($res->access_token)) {
            if (isset($res->response)) {
                $error = $res->response->errors[0]->message;
            } else {
                $error = "Authentication Failed! Please try again.";
            }
            return ['status' => 'fail', 'msg' => $error];
        }

        $access_token = $res->access_token;
        return ['status' => 'success', 'access_token' => $access_token];
    }

    /**
     * Get Payload
     * @return string
     */
    private function _getPayload()
    {
        return "grant_type=client_credentials";
    }

    /**
     * Set Mode
     * @param string DEV|PROD
     */
    public function setMode(String $mode)
    {
        if ($mode === 'PROD') {
            $this->_mode = $mode;
            return $mode;
        }

        $this->_mode = 'DEV';
        return $mode;
    }

    /**
     * Get Api Base URL
     * @return string url
     */
    protected function _getAPIBaseURL()
    {
        if ($this->_mode === 'PROD') {
            return $this->_prod_api_base_url;
        }

        return $this->_dev_api_base_url;
    }
}
