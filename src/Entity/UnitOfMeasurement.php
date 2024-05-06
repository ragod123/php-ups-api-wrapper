<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class UnitOfMeasurement
{
    public const INCHES = "IN";
    public const CENTIMETERS = "CM";
    public const METRIC_UNITS_OF_MEASUREMENT = "00";
    public const ENGLISH_UNITS_OF_MEASUREMENT = "01";
    public const POUNDS = "LBS";
    public const KILOGRAMS = "KGS";
    public const OUNCES = "OZS";

    private ?string $code;
    private ?string $description;

    public function setCode(string $code): self
    {
        if (in_array($code, [self::INCHES, self::CENTIMETERS, self::METRIC_UNITS_OF_MEASUREMENT, self::ENGLISH_UNITS_OF_MEASUREMENT, self::POUNDS, self::KILOGRAMS, self::OUNCES])) {
            $this->code = $code;
            return $this;
        }

        throw new \Exception("Unit of Measurement code doesn't exists.");
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function toArray(): array
    {
        $measurement = [
            "Code" => $this->code
        ];

        if ($this->description) {
            $measurement["Description"] = $this->description;
        }

        return $measurement;
    }
}
