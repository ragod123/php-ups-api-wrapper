<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Utils;

class HttpClient
{
    private array $header;
    private ?string $payload;
    private string $url;
    private string $method;

    public function setHeader(array $header): self
    {
        $this->header = $header;
        return $this;
    }
    
    public function setPayload(string $payload): self
    {
        $this->payload = $payload;
        return $this;
    }
    
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }
    
    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }

    public function fetch(): object
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_HTTPHEADER => $this->header,
                CURLOPT_POSTFIELDS => $this->payload,
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => strtoupper($this->method),
            ]);
    
            $response = curl_exec($curl);
            curl_close($curl);
            
            return json_decode($response);
        } catch (\Exception $e) {
            throw new \Exception("Curl request Failed. Reason: ". $e->getMessage());
        }
    }
}