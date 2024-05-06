<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class LabelImageFormat
{
    public const GIF = "GIF";
    public const ZPL = "ZPL";
    public const EPL = "EPL";
    public const SPL = "SPL";

    private ?string $code;
    private ?string $description;

    public function setCode(string $code): self
    {
        if (in_array($code, [self::GIF, self::ZPL, self::EPL, self::SPL])) {
            $this->code = $code;
            return $this;
        }

        throw new \Exception("LabelImageFormat code doesn't exists.");
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
        $labelImageFormat = [
            "Code" => $this->code
        ];

        if ($this->description) {
            $labelImageFormat["Description"] = $this->description;
        }

        return $labelImageFormat;
    }
}