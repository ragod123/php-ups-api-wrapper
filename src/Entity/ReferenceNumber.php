<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class ReferenceNumber
{
    private string $code = "";
    private string $value = "";

    public function exists()
    {
        if (!empty($this->value)) {
            return true;
        }

        return false;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function toArray(): array
    {
        $referenceNumber = [
            "Value" => $this->value
        ];

        if ($this->code) {
            $referenceNumber["Code"] = $this->code;
        }

        return $referenceNumber;
    }
}
