<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class Package
{
    private string $description = "";
    private Packaging $packaging;
    private Dimensions $dimensions;
    private PackageWeight $packageWeight;
    private ReferenceNumber $referenceNumber;
    
    public function __construct()
    {
        $this->dimensions = new Dimensions();
        $this->packageWeight = new PackageWeight();
        $this->referenceNumber = new ReferenceNumber();
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

    public function setReferenceNumber(ReferenceNumber $referenceNumber): self
    {
        $this->referenceNumber = $referenceNumber;
        return $this;
    }

    public function getReferenceNumber(): ReferenceNumber
    {
        return $this->referenceNumber;
    }

    public function setPackaging(Packaging $packaging): self
    {
        $this->packaging = $packaging;
        return $this;
    }

    public function getPackaging(): Packaging
    {
        return $this->packaging;
    }

    public function setDimensions(Dimensions $dimensions): self
    {
        $this->dimensions = $dimensions;
        return $this;
    }

    public function getDimensions(): Dimensions
    {
        return $this->dimensions;
    }

    public function setPackageWeight(PackageWeight $packageWeight): self
    {
        $this->packageWeight = $packageWeight;
        return $this;
    }

    public function getPackageWeight(): PackageWeight
    {
        return $this->packageWeight;
    }

    public function toArray(): array
    {
        $package = [
            "Packaging" => $this->packaging->toArray()
        ];

        if ($this->description) {
            $package["Description"] = $this->description;
        }

        if ($this->dimensions->exists()) {
            $package["Dimensions"] = $this->dimensions->toArray();
        }
        
        if ($this->packageWeight->exists()) {
            $package["PackageWeight"] = $this->packageWeight->toArray();
        }
        
        if ($this->referenceNumber->exists()) {
            $package["ReferenceNumber"] = $this->referenceNumber->toArray();
        }

        return $package;
    }
}
