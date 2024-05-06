<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class Phone
{
    private ?string $number;
    private string $extension = "";

    public function setNumber(string $number): self
    {
        $this->number = $number;
        return $this;
    }
    
    public function getNumber(): string
    {
        return $this->number;
    }
    
    public function setExtension(string $extension): self
    {
        $this->extension = $extension;
        return $this;
    }
    
    public function getExtension(): string
    {
        return $this->extension;
    }

    public function toArray(): array
    {
        $phone = [
            "Number" => $this->number
        ];

        if ($this->extension) {
            $phone["Extension"] = $this->extension;
        }

        return $phone;
    }
}