<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class ValidateAddressQuery
{
    private ?string $regionalRequestIndicator;
    private ?string $maximumCandidateListSize;

    public function exists()
    {
        if (!empty($this->regionalRequestIndicator) || !empty($this->maximumCandidateListSize)) {
            return true;
        }

        return false;
    }

    public function setRegionalRequestIndicator(string $regionalRequestIndicator): self
    {
        if (in_array($regionalRequestIndicator, ["True", "False"])) {
            $this->regionalRequestIndicator = $regionalRequestIndicator;
            return $this;
        }

        throw new \Exception("Regional Request Indicator is not valid.");
    }
    
    public function getRegionalRequestIndicator(): string
    {
        return $this->regionalRequestIndicator;
    }
    
    public function setMaximumCandidateListSize(string $maximumCandidateListSize): self
    {
        if ($maximumCandidateListSize >= 0 && $maximumCandidateListSize <= 50) {
            $this->maximumCandidateListSize = $maximumCandidateListSize;
            return $this;
        }

        throw new \Exception("Maximum Candidate List Size is not valid. Should be between 0-50.");
    }
    
    public function getMaximumCandidateListSize(): string
    {
        return $this->maximumCandidateListSize;
    }

    public function toArray(): array
    {
        $address = [];

        if (isset($this->regionalRequestIndicator)) {
            $address["regionalrequestindicator"] = $this->regionalRequestIndicator;
        }
        
        if (isset($this->maximumCandidateListSize)) {
            $address["maximumcandidatelistsize"] = $this->maximumCandidateListSize;
        }

        return $address;
    }
}