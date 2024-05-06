<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class LabelSpecification
{
    private LabelImageFormat $labelImageFormat;
    private LabelStockSize $labelStockSize;
    private ?string $httpUserAgent;

    public function setLabelImageFormat(LabelImageFormat $labelImageFormat): self
    {
        $this->labelImageFormat = $labelImageFormat;
        return $this;
    }

    public function getLabelImageFormat(): LabelImageFormat
    {
        return $this->labelImageFormat;
    }

    public function setLabelStockSize(LabelStockSize $labelStockSize): self
    {
        $this->labelStockSize = $labelStockSize;
        return $this;
    }

    public function getLabelStockSize(): LabelStockSize
    {
        return $this->labelStockSize;
    }

    public function setHttpUserAgent(string $httpUserAgent): self
    {
        $this->httpUserAgent = $httpUserAgent;
        return $this;
    }

    public function getHttpUserAgent(): string
    {
        return $this->httpUserAgent;
    }

    public function toArray(): array
    {
        $labelSpecification = [
            "LabelImageFormat" => $this->labelImageFormat->toArray(),
            "LabelStockSize" => $this->labelStockSize->toArray()
        ];

        if ($this->httpUserAgent) {
            $labelSpecification["HTTPUserAgent"] = $this->httpUserAgent;
        }

        return $labelSpecification;
    }
}
