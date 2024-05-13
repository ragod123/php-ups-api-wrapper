<?php

namespace RahulGodiyal\PhpUpsApiWrapper;

use RahulGodiyal\PhpUpsApiWrapper\Auth;
use RahulGodiyal\PhpUpsApiWrapper\Entity\ShipQuery;
use RahulGodiyal\PhpUpsApiWrapper\Entity\ShipmentRequest;
use RahulGodiyal\PhpUpsApiWrapper\Utils\HttpClient;

class Ship extends Auth
{
    private const VERSION = "v2403";

    private ShipQuery $query;
    private ShipmentRequest $shipmentRequest;
    private bool $onlyLabel;

    public function __construct()
    {
        $this->query = new ShipQuery();
        $this->onlyLabel = false;
    }

    public function setQuery(ShipQuery $query): self
    {
        $this->query = $query;
        return $this;
    }

    public function getQuery(): ShipQuery
    {
        return $this->query;
    }

    public function setShipmentRequest(ShipmentRequest $shipmentRequest): self
    {
        $this->shipmentRequest = $shipmentRequest;
        return $this;
    }

    public function getShipmentRequest(): ShipmentRequest
    {
        return $this->shipmentRequest;
    }

    public function createShipment(string $client_id, string $client_secret): array
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
            "Content-Type: application/json",
            "transId: string",
            "transactionSrc: testing"
        ]);
        $httpClient->setPayload(json_encode($this->getPayload()));
        $httpClient->setUrl($this->_getAPIBaseURL() . "/api/shipments/" . self::VERSION . "/ship" . $queryParams);
        $httpClient->setMethod("POST");
        $res = $httpClient->fetch();

        if (!isset($res->ShipmentResponse)) {
            if (isset($res->response)) {
                $error = $res->response->errors[0]->message;
            } else {
                $error = "Shipment creation failed! Please try again.";
            }
            return ['status' => 'fail', 'msg' => $error];
        }

        if (!isset($res->ShipmentResponse->ShipmentResults)) {
            return ['status' => 'fail', 'msg' => "Invalid Request."];
        }

        if ($this->onlyLabel) {
            $shipmentRes = $res->ShipmentResponse->ShipmentResults;
            if (!isset($shipmentRes->PackageResults)) {
                return ['status' => 'fail', 'msg' => "Label data is not present in response."];
            }

            $packageRes = $shipmentRes->PackageResults;
            if (!isset($packageRes[0]->ShippingLabel)) {
                return ['status' => 'fail', 'msg' => "Label data is not present in response."];
            }

            return ['status' => 'success', 'data' => $packageRes[0]->ShippingLabel];
        }


        return ['status' => 'success', 'data' => $res];
    }

    private function getPayload(): array
    {
        return [
            "ShipmentRequest" => $this->shipmentRequest->toArray()
        ];
    }

    public function setMode(string $mode): self
    {
        parent::setMode($mode);
        return $this;
    }

    public function setOnlyLabel(bool $onlyLabel): self
    {
        $this->onlyLabel = $onlyLabel;
        return $this;
    }
}
