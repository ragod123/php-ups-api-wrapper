<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class LabelStockSize
{
    public const H_6 = "6";
    public const H_8 = "8";
    public const W_4 = "4";

    private ?string $height;
    private ?string $width;

    public function setHeight(string $height): self
    {
        if (in_array($height, [self::H_6, self::H_8])) {
            $this->height = $height;
            return $this;
        }

        throw new \Exception("LabelStockSize height can be only 6 or 8");
    }

    public function getHeight(): string
    {
        return $this->height;
    }

    public function setWidth(string $width): self
    {
        if ($width == self::W_4) {
            $this->width = $width;
            return $this;
        }

        throw new \Exception("LabelStockSize width can be only 4");
    }

    public function getWidth(): string
    {
        return $this->width;
    }

    public function toArray(): array
    {
        return [
            "Height" => $this->height,
            "Width" => $this->width
        ];
    }
}