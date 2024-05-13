<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class TrackingQuery
{
    private ?string $locale;
    private ?string $returnSignature;
    private ?string $returnMilestones;
    private ?string $returnPOD;

    public function exists()
    {
        if (
            !empty($this->locale) 
            || !empty($this->returnSignature)
            || !empty($this->returnMilestones)
            || !empty($this->returnPOD)
        ) {
            return true;
        }

        return false;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }
    
    public function setReturnSignature(string $returnSignature): self
    {
        if (in_array(strtolower($returnSignature), ['true', 'false'])) {
            $this->returnSignature = $returnSignature;
            return $this;
        }

        throw new \Exception("Return Signature is not valid.");
    }

    public function setReturnMilestones(string $returnMilestones): self
    {
        if (in_array(strtolower($returnMilestones), ['true', 'false'])) {
            $this->returnMilestones = $returnMilestones;
            return $this;
        }

        throw new \Exception("Return Milestones is not valid.");
    }
    
    public function setReturnPOD(string $returnPOD): self
    {
        if (in_array(strtolower($returnPOD), ['true', 'false'])) {
            $this->returnPOD = $returnPOD;
            return $this;
        }

        throw new \Exception("Return POD is not valid.");
    }

    public function toArray(): array
    {
        $query = [];

        if (isset($this->locale)) {
            $query["locale"] = $this->locale;
        }
        
        if (isset($this->returnSignature)) {
            $query["returnSignature"] = $this->returnSignature;
        }
        
        if (isset($this->returnMilestones)) {
            $query["returnMilestones"] = $this->returnMilestones;
        }
        
        if (isset($this->returnPOD)) {
            $query["returnPOD"] = $this->returnPOD;
        }

        return $query;
    }
}