<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class PackageWeight
{
    private UnitOfMeasurement $unitOfMeasurement;
    private ?string $weight;

    public function setUnitOfMeasurement(UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->unitOfMeasurement = $unitOfMeasurement;
        return $this;
    }

    public function getUnitOfMeasurement(): UnitOfMeasurement
    {
        return $this->unitOfMeasurement;
    }

    public function setWeight(string $weight): self
    {
        $this->weight = $weight;
        return $this;
    }

    public function getWeight(): string
    {
        return $this->weight;
    }

    public function toArray(): array
    {
        return [
            "UnitOfMeasurement" => $this->unitOfMeasurement->toArray(),
            "Weight" => $this->weight
        ];
    }
}
