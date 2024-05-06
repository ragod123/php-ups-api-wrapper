<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class PaymentInformation
{
    private ShipmentCharge $shipmentCharge;

    public function exists()
    {
        return $this->shipmentCharge->exists();
    }

    public function __construct()
    {
        $this->shipmentCharge = new ShipmentCharge();
    }

    public function setShipmentCharge(ShipmentCharge $shipmentCharge): self
    {
        $this->shipmentCharge = $shipmentCharge;
        return $this;
    }

    public function getShipmentCharge(): ShipmentCharge
    {
        return $this->shipmentCharge;
    }

    public function toArray(): array
    {
        return [
            "ShipmentCharge" => $this->shipmentCharge->toArray()
        ];
    }
}