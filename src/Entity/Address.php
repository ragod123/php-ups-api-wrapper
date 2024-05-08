<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class Address
{
    private array $addressLines = [];
    private ?string $city;
    private ?string $stateProvinceCode;
    private ?string $postalCode;
    private ?string $countryCode;

    public function setAddressLines(array $addressLines): self
    {
        $this->addressLines = $addressLines;
        return $this;
    }

    public function getAddressLines(): array
    {
        return $this->addressLines;
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
        return [
            "AddressLine" => $this->addressLines,
            "City" => $this->city,
            "StateProvinceCode" => $this->stateProvinceCode,
            "PostalCode" => $this->postalCode,
            "CountryCode" => $this->countryCode
        ];
    }
}
