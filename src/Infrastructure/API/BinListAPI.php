<?php
namespace App\Infrastructure\API;

use App\Domain\Interfaces\BinServiceAPI;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class BinListAPI implements BinServiceAPI
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://lookup.binlist.net/',
        ]);
    }

    #[\Override]
    public function getCountryCode(string $bin): string
    {
        try {
            $response = $this->client->get($bin);
            $body = $response->getBody()->getContents();
            $data = json_decode($body);

            if (!isset($data->country->alpha2)) {
                throw new \RuntimeException("Country code not found for BIN:". $bin);
            }

            return $data->country->alpha2;
        } catch (GuzzleException $e) {
            throw new \RuntimeException("HTTP error:". $e->getMessage(), 0, $e);
        }
    }
}