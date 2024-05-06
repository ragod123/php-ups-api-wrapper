<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class Packaging
{
    public const UPS_LETTER = "01";
    public const CUSTOMER_SUPPLIED_PACKAGE = "02";
    public const TUBE = "03";
    public const PAK = "04";
    public const UPS_EXPRESS_BOX = "21";
    public const UPS_25KG_BOX = "24";
    public const UPS_10KG_BOX = "25";
    public const PALLET = "30";
    public const SMALL_EXPRESS_BOX = "2a";
    public const MEDIUM_EXPRESS_BOX = "2b";
    public const LARGE_EXPRESS_BOX = "2c";
    public const FLATS = "56";
    public const PARCELS = "57";
    public const BPM = "58";
    public const FIRST_CLASS = "59";
    public const PRIORITY = "60";
    public const MACHINEABLES = "61";
    public const IRREGULARS = "62";
    public const PARCEL_POST = "63";
    public const BPM_PARCEL = "64";
    public const MEDIA_MAIL = "65";
    public const BPM_FLAT = "66";
    public const STANDARD_FLAT = "67";

    private ?string $code;
    private ?string $description;

    public function setCode(string $code): self
    {
        if (in_array($code, [self::UPS_LETTER, self::CUSTOMER_SUPPLIED_PACKAGE, self::TUBE, self::PAK, self::UPS_EXPRESS_BOX, self::UPS_25KG_BOX, self::UPS_10KG_BOX, self::PALLET, self::SMALL_EXPRESS_BOX, self::MEDIUM_EXPRESS_BOX, self::LARGE_EXPRESS_BOX, self::FLATS, self::PARCELS, self::BPM, self::FIRST_CLASS, self::PRIORITY, self::MACHINEABLES, self::IRREGULARS, self::PARCEL_POST, self::BPM_PARCEL, self::MEDIA_MAIL, self::BPM_FLAT, self::STANDARD_FLAT])) {
            $this->code = $code;
            return $this;
        }

        throw new \Exception("Packaging code doesn't exists.");
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
        $packaging = [
            "Code" => $this->code
        ];

        if ($this->description) {
            $packaging["Description"] = $this->description;
        }

        return $packaging;
    }
}