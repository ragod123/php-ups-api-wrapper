<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class ShipQuery
{
    private string $additionalAddressValidation = "";

    public function exists()
    {
        if (!empty($this->additionalAddressValidation)) {
            return true;
        }

        return false;
    }

    public function setAdditionalAddressValidation(string $additionalAddressValidation): self
    {
        $this->additionalAddressValidation = $additionalAddressValidation;
        return $this;
    }
    
    public function getAdditionalAddressValidation(): string
    {
        return $this->additionalAddressValidation;
    }

    public function toArray(): array
    {
        if ($this->additionalAddressValidation) {
            return [
                "additionaladdressvalidation" => $this->additionalAddressValidation
            ];
        }

        return [];
    }
}