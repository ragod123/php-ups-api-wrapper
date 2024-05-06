<?php

namespace RahulGodiyal\PhpUpsApiWrapper;

use RahulGodiyal\PhpUpsApiWrapper\Utils\HttpClient;

class Auth
{
    private const DEV_API_BASE_URL = 'https://wwwcie.ups.com';
    private const PROD_API_BASE_URL = 'https://onlinetools.ups.com';

    private string $mode = 'DEV';

    public function setMode(string $mode): self
    {
        if ($mode === 'PROD') {
            $this->mode = $mode;
        }

        return $this;
    }

    public function authenticate(string $client_id, string $client_secret): array
    {
        $httpClient = new HttpClient();
        $httpClient->setHeader([
            "Content-Type: application/x-www-form-urlencoded",
            "x-merchant-id: string",
            "Authorization: Basic " . base64_encode($client_id . ":" . $client_secret)
        ]);
        $httpClient->setPayload("grant_type=client_credentials");
        $httpClient->setUrl($this->_getAPIBaseURL() . "/security/v1/oauth/token");
        $httpClient->setMethod("POST");
        $res = $httpClient->fetch();

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

    protected function _getAPIBaseURL(): string
    {
        if ($this->mode === 'PROD') {
            return self::PROD_API_BASE_URL;
        }

        return self::DEV_API_BASE_URL;
    }
}
