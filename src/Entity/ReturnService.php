<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class ReturnService
{
    public const UPS_PRINT_AND_MAIL = "2";
    public const UPS_RETURN_SERVICE_1_ATTEMPT = "3";
    public const UPS_RETURN_SERVICE_3_ATTEMPT = "5";
    public const UPS_ELECTRONIC_RETURN_LABEL = "8";
    public const UPS_PRINT_RETURN_LABEL = "9";
    public const UPS_EXCHANGE_PRINT_RETURN_LABEL = "10";
    public const UPS_PACK_AND_COLLECT_SERVICE_1_ATTEMPT_BOX_1 = "11";
    public const UPS_PACK_AND_COLLECT_SERVICE_1_ATTEMPT_BOX_2 = "12";
    public const UPS_PACK_AND_COLLECT_SERVICE_1_ATTEMPT_BOX_3 = "13";
    public const UPS_PACK_AND_COLLECT_SERVICE_1_ATTEMPT_BOX_4 = "14";
    public const UPS_PACK_AND_COLLECT_SERVICE_1_ATTEMPT_BOX_5 = "15";
    public const UPS_PACK_AND_COLLECT_SERVICE_3_ATTEMPT_BOX_1 = "16";
    public const UPS_PACK_AND_COLLECT_SERVICE_3_ATTEMPT_BOX_2 = "17";
    public const UPS_PACK_AND_COLLECT_SERVICE_3_ATTEMPT_BOX_3 = "18";
    public const UPS_PACK_AND_COLLECT_SERVICE_3_ATTEMPT_BOX_4 = "19";
    public const UPS_PACK_AND_COLLECT_SERVICE_3_ATTEMPT_BOX_5 = "20";

    private string $code = "";
    private string $description = "";

    public function exists()
    {
        if (!empty($this->code) && !empty($this->code)) {
            return true;
        }

        return false;
    }

    public function setCode(string $code): self
    {
        if (in_array($code, [
            self::UPS_PRINT_AND_MAIL, self::UPS_RETURN_SERVICE_1_ATTEMPT, self::UPS_RETURN_SERVICE_3_ATTEMPT, self::UPS_ELECTRONIC_RETURN_LABEL, self::UPS_PRINT_RETURN_LABEL, self::UPS_EXCHANGE_PRINT_RETURN_LABEL, self::UPS_PACK_AND_COLLECT_SERVICE_1_ATTEMPT_BOX_1, self::UPS_PACK_AND_COLLECT_SERVICE_1_ATTEMPT_BOX_2, self::UPS_PACK_AND_COLLECT_SERVICE_1_ATTEMPT_BOX_3, self::UPS_PACK_AND_COLLECT_SERVICE_1_ATTEMPT_BOX_4, self::UPS_PACK_AND_COLLECT_SERVICE_1_ATTEMPT_BOX_5, self::UPS_PACK_AND_COLLECT_SERVICE_3_ATTEMPT_BOX_1, self::UPS_PACK_AND_COLLECT_SERVICE_3_ATTEMPT_BOX_2, self::UPS_PACK_AND_COLLECT_SERVICE_3_ATTEMPT_BOX_3, self::UPS_PACK_AND_COLLECT_SERVICE_3_ATTEMPT_BOX_4, self::UPS_PACK_AND_COLLECT_SERVICE_3_ATTEMPT_BOX_5
        ])) {
            $this->code = $code;
            return $this;
        }

        throw new \Exception("ReturnService Code doesn't exists.");
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
