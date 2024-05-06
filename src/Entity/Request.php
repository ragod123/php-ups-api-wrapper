<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class Request
{
    public const REQUEST_OPTION = "nonvalidate";
    private ?string $subVersion;

    public function __construct()
    {
        $this->subVersion = "";
    }

    public function setSubVersion(string $subVersion): self
    {
        if (in_array($subVersion, ["1601", "1607", "1701", "1707", "1801", "1807", "2108", "2205"])) {
            $this->subVersion = $subVersion;
            return $this;
        }

        throw new \Exception("SubVersion value doesn't exists.");
    }

    public function getSubVersion(): string
    {
        return $this->subVersion;
    }

    public function toArray(): array
    {
        $request = [
            "RequestOption" => self::REQUEST_OPTION
        ];

        if ($this->subVersion) {
            $request["SubVersion"] = $this->subVersion;
        }

        return $request;
    }
}
