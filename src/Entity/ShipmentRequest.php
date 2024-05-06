<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class ShipmentRequest
{
    private Request $request;
    private Shipment $shipment;
    private LabelSpecification $labelSpecification;

    public function setRequest(Request $request): self
    {
        $this->request = $request;
        return $this;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function setShipment(Shipment $shipment): self
    {
        $this->shipment = $shipment;
        return $this;
    }

    public function getShipment(): Shipment
    {
        return $this->shipment;
    }

    public function setLabelSpecification(LabelSpecification $labelSpecification): self
    {
        $this->labelSpecification = $labelSpecification;
        return $this;
    }

    public function getLabelSpecification(): LabelSpecification
    {
        return $this->labelSpecification;
    }

    public function toArray(): array
    {
        $shipmentRequest = [
            "Request" => $this->request->toArray(),
            "Shipment" => $this->shipment->toArray()
        ];

        if ($this->labelSpecification) {
            $shipmentRequest["LabelSpecification"] = $this->labelSpecification->toArray();
        }

        return $shipmentRequest;
    }
}
