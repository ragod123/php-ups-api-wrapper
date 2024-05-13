<?php

namespace RahulGodiyal\PhpUpsApiWrapper;

use RahulGodiyal\PhpUpsApiWrapper\Auth;
use RahulGodiyal\PhpUpsApiWrapper\Entity\TrackingQuery;
use RahulGodiyal\PhpUpsApiWrapper\Utils\HttpClient;

class Tracking extends Auth
{
    private TrackingQuery $query;
    private ?string $trackingNumber;

    public function __construct()
    {
        $this->query = new TrackingQuery();
    }

    public function setQuery(TrackingQuery $query): self
    {
        $this->query = $query;
        return $this;
    }

    public function setTrackingNumber(string $trackingNumber): self
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    public function fetch(string $client_id, string $client_secret): array
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
            "transId: string",
            "transactionSrc: testing"
        ]);
        $httpClient->setUrl($this->_getAPIBaseURL() . "/api/track/v1/details/" . $this->trackingNumber . $queryParams);
        $httpClient->setMethod("GET");
        $res = $httpClient->fetch();

        if (!isset($res->trackResponse)) {
            if (isset($res->response)) {
                $error = $res->response->errors[0]->message;
            } else {
                $error = "Fetching tracking details failed! Please try again.";
            }
            return ['status' => 'fail', 'msg' => $error];
        }

        if (!isset($res->trackResponse->shipment)) {
            return ['status' => 'fail', 'msg' => "Invalid Tracking Number."];
        }

        if (isset($res->trackResponse->shipment[0]->warnings)) {
            $error_arr = $res->trackResponse->shipment[0]->warnings;
            if (isset($error_arr[0]->message)) {
                return ['status' => 'fail', 'msg' => $error_arr[0]->message];
            }
        }

        $trackingDetails = $res->trackResponse->shipment;
        return ['status' => 'success', 'data' => $trackingDetails];
    }

    public function setMode(string $mode): self
    {
        parent::setMode($mode);
        return $this;
    }
}
