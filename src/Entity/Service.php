<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class Service
{
    public const NEXT_DAY_AIR = "01";
    public const SECOND_DAY_AIR = "02";
    public const GROUND = "03";
    public const EXPRESS = "07";
    public const EXPEDITED = "08";
    public const UPS_STANDARD = "11";
    public const THREE_DAY_SELECT = "12";
    public const NEXT_DAY_AIR_SAVER = "13";
    public const UPS_NEXT_DAY_AIR_EARLY = "14";
    public const UPS_WORLDWIDE_ECONOMY_DDU = "17";
    public const EXPRESS_PLUS = "54";
    public const SECOND_DAY_AIR_A_M = "59";
    public const UPS_SAVER = "65";
    public const FIRST_CLASS_MAIL = "M2";
    public const PRIORITY_MAIL = "M3";
    public const EXPEDITED_MAIL_INNOVATIONS = "M4";
    public const PRIORITY_MAIL_INNOVATIONS = "M5";
    public const ECONOMY_MAIL_INNOVATIONS = "M6";
    public const MAIL_INNOVATIONS_MI_RETURNS = "M7";
    public const UPS_ACCESS_POINT_ECONOMY = "70";
    public const UPS_WORLDWIDE_EXPRESS_FREIGHT_MIDDAY = "71";
    public const UPS_WORLDWIDE_ECONOMY_DDP = "72";
    public const UPS_EXPRESS_12_00 = "74";
    public const UPS_HEAVY_GOODS = "75";
    public const UPS_TODAY_STANDARD = "82";
    public const UPS_TODAY_DEDICATED_COURIER = "83";
    public const UPS_TODAY_INTERCITY = "84";
    public const UPS_TODAY_EXPRESS = "85";
    public const UPS_TODAY_EXPRESS_SAVER = "86";
    public const UPS_WORLDWIDE_EXPRESS_FREIGHT = "96";

    private ?string $code;
    private string $description = "";

    public function setCode(string $code): self
    {
        if (in_array($code, [
            self::NEXT_DAY_AIR, self::SECOND_DAY_AIR, self::GROUND, self::EXPRESS, self::EXPEDITED, self::UPS_STANDARD, self::THREE_DAY_SELECT, self::NEXT_DAY_AIR_SAVER, self::UPS_NEXT_DAY_AIR_EARLY, self::UPS_WORLDWIDE_ECONOMY_DDU, self::EXPRESS_PLUS, self::SECOND_DAY_AIR_A_M, self::UPS_SAVER, self::FIRST_CLASS_MAIL, self::PRIORITY_MAIL, self::EXPEDITED_MAIL_INNOVATIONS, self::PRIORITY_MAIL_INNOVATIONS, self::ECONOMY_MAIL_INNOVATIONS, self::MAIL_INNOVATIONS_MI_RETURNS, self::UPS_ACCESS_POINT_ECONOMY, self::UPS_WORLDWIDE_EXPRESS_FREIGHT_MIDDAY, self::UPS_WORLDWIDE_ECONOMY_DDP, self::UPS_EXPRESS_12_00, self::UPS_HEAVY_GOODS, self::UPS_TODAY_STANDARD, self::UPS_TODAY_DEDICATED_COURIER, self::UPS_TODAY_INTERCITY, self::UPS_TODAY_EXPRESS, self::UPS_TODAY_EXPRESS_SAVER, self::UPS_WORLDWIDE_EXPRESS_FREIGHT
        ])) {
            $this->code = $code;    
            return $this;
        }
        
        throw new \Exception("Service Code doesn't exists.");
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
        $service = [
            "Code" => $this->code
        ];

        if ($this->description) {
            $service["Description"] = $this->description;
        }

        return $service;
    }
}
