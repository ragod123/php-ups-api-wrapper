<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class Address
{
    private ?string $addressLine1;
    private ?string $addressLine2;
    private ?string $city;
    private ?string $stateProvinceCode;
    private ?string $postalCode;
    private ?string $countryCode;

    public function setAddressLine1(string $addressLine1): self
    {
        $this->addressLine1 = $addressLine1;
        return $this;
    }

    public function getAddressLine1(): string | null
    {
        return $this->addressLine1;
    }
    
    public function setAddressLine2(string $addressLine2): self
    {
        $this->addressLine2 = $addressLine2;
        return $this;
    }

    public function getAddressLine2(): string | null
    {
        return $this->addressLine2;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }
    
    public function getCity(): string | null
    {
        return $this->city;
    }
    
    public function setStateProvinceCode(string $state): self
    {
        $this->stateProvinceCode = $state;
        return $this;
    }

    public function getStateProvinceCode(): string | null
    {
        return $this->stateProvinceCode;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postalCode = $postal_code;
        return $this;
    }
    
    public function getPostalCode(): string | null
    {
        return $this->postalCode;
    }
    
    public function setCountryCode(string $country_code): self
    {
        $this->countryCode = $country_code;
        return $this;
    }

    public function getCountryCode(): string | null
    {
        return $this->countryCode;
    }

    public function toArray(): array
    {
        $address_lines = [$this->addressLine1];

        if ($this->addressLine2) {
            array_push($address_lines, $this->addressLine2);
        }

        return [
            "AddressLine" => $address_lines,
            "City" => $this->city,
            "StateProvinceCode" => $this->stateProvinceCode,
            "PostalCode" => $this->postalCode,
            "CountryCode" => $this->countryCode
        ];
    }
}
