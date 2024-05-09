<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class Shipper
{
    private ?string $name;
    private string $attentionName = "";
    private string $taxIdentificationNumber = "";
    private Phone $phone;
    private ?string $shipperNumber;
    private string $faxNumber = "";
    private Address $address;

    public function __construct()
    {
        $this->phone = new Phone();
    }

    public function setName(string $name): self
    {
        $this->name = mb_substr($name, 0, 35);
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setAttentionName(string $attn_name): self
    {
        $this->attentionName = mb_substr($attn_name, 0, 35);
        return $this;
    }

    public function getAttentionName(): string
    {
        return $this->attentionName;
    }

    public function setTaxIdentificationNumber(string $tax_identification_number): self
    {
        $this->taxIdentificationNumber = $tax_identification_number;
        return $this;
    }

    public function getTaxIdentificationNumber(): string
    {
        return $this->taxIdentificationNumber;
    }

    public function setPhone(Phone $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }

    public function setShippingNumber(string $shipper_number): self
    {
        $this->shipperNumber = $shipper_number;
        return $this;
    }

    public function getShippingNumber(): string
    {
        return $this->shipperNumber;
    }

    public function setFaxNumber(string $fax_number): self
    {
        $this->faxNumber = $fax_number;
        return $this;
    }

    public function getFaxNumber(): string
    {
        return $this->faxNumber;
    }

    public function setAddress(Address $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function toArray(): array
    {
        $shipper = [
            "Name" => $this->name,
            "ShipperNumber" => $this->shipperNumber,
            "Address" => $this->address->toArray()
        ];

        if ($this->attentionName) {
            $shipper["AttentionName"] = $this->attentionName;
        }

        if ($this->taxIdentificationNumber) {
            $shipper["TaxIdentificationNumber"] = $this->taxIdentificationNumber;
        }

        if ($this->phone->exists()) {
            $shipper["Phone"] = $this->phone->toArray();
        }

        if ($this->faxNumber) {
            $shipper["FaxNumber"] = $this->faxNumber;
        }

        return $shipper;
    }
}
