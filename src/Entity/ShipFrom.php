<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class ShipFrom
{
    private ?string $name;
    private string $attentionName = "";
    private Phone $phone;
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

    public function setPhone(Phone $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
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
        $shipFrom = [
            "Name" => $this->name,
            "Address" => $this->address->toArray()
        ];

        if ($this->attentionName) {
            $shipFrom["AttentionName"] = $this->attentionName;
        }
        
        if ($this->phone->exists()) {
            $shipFrom["Phone"] = $this->phone->toArray();
        }

        if ($this->faxNumber) {
            $shipFrom["FaxNumber"] = $this->faxNumber;
        }

        return $shipFrom;
    }
}
