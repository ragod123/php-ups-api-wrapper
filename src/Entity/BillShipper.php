<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class BillShipper
{
    private string $accountNumber = "";

    public function exists()
    {
        if (!empty($this->accountNumber)) {
            return true;
        }

        return false;
    }

    public function setAccountNumber(string $accountNumber): self
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    public function toArray(): array
    {
        return [
            "AccountNumber" => $this->accountNumber
        ];
    }
}