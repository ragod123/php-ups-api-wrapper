<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class ShipmentCharge
{
    const TYPE = "01";

    private BillShipper $billShipper;

    public function exists()
    {
        return $this->billShipper->exists();
    }

    public function __construct()
    {
        $this->billShipper = new BillShipper();
    }

    public function setBillShipper(BillShipper $billShipper): self
    {
        $this->billShipper = $billShipper;
        return $this;
    }

    public function getBillShipper(): BillShipper
    {
        return $this->billShipper;
    }

    public function toArray(): array
    {
        $shipmentCharge = [
            "Type" => self::TYPE
        ];

        if ($this->billShipper->exists()) {
            $shipmentCharge["BillShipper"] = $this->billShipper->toArray();
        }

        return $shipmentCharge;
    }
}