<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class Dimensions
{
    private UnitOfMeasurement $unitOfMeasurement;
    private ?string $length;
    private ?string $width;
    private ?string $height;

    public function setUnitOfMeasurement(UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->unitOfMeasurement = $unitOfMeasurement;
        return $this;
    }

    public function getUnitOfMeasurement(): UnitOfMeasurement
    {
        return $this->unitOfMeasurement;
    }

    public function setLength(string $length): self
    {
        if ($this->unitOfMeasurement->getCode() == 'IN') {
            if ($length >= 0 && $length <= 108) {
                $this->length = $length;
                return $this;
            }
        }

        if ($this->unitOfMeasurement->getCode() == 'CM') {
            if ($length >= 0 && $length <= 270) {
                $this->length = $length;
                return $this;
            }
        }

        throw new \Exception("Length value is not valid.");
    }

    public function getLength(): string
    {
        return $this->length;
    }

    public function setWidth(string $width): self
    {
        $this->width = $width;
        return $this;
    }

    public function getWidth(): string
    {
        return $this->width;
    }

    public function setHeight(string $height): self
    {
        $this->height = $height;
        return $this;
    }

    public function getHeight(): string
    {
        return $this->height;
    }

    public function toArray(): array
    {
        return [
            "UnitOfMeasurement" => $this->unitOfMeasurement->toArray(),
            "Length" => $this->length,
            "Width" => $this->width,
            "Height" => $this->height
        ];
    }
}
