<?php

namespace App\Infrastructure\API;

use App\Domain\Interfaces\BinServiceAPI;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;

class BinCheckerAPI implements BinServiceAPI
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://bin-ip-checker.p.rapidapi.com/',
            'headers' => [
                'x-rapidapi-key' => '0dfa94ffc0msh0e084d5a77680eap1f9d16jsncf7de8b36fcb',
                'x-rapidapi-host' => 'bin-ip-checker.p.rapidapi.com',
                'Content-Type' => 'application/json'
            ]
        ]);
    }


    #[\Override] public function getCountryCode(string $bin): string
    {
        try {
            $response = $this->client->post("/?bin=$bin");
            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);

            $countryCode = $data['BIN']['country']['alpha2'] ?? null;

            if (!$countryCode)
                throw new RuntimeException('Country code not found for BIN: '.$bin);
            return $countryCode;
        }
        catch (GuzzleException $e) {
            throw new \RuntimeException("HTTP error:". $e->getMessage(), 0, $e);
        }
    }
}