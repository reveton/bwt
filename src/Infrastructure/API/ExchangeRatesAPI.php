<?php
namespace App\Infrastructure\API;

use App\Domain\Interfaces\ExchangeRateAPI;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ExchangeRatesAPI implements ExchangeRateAPI {

    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.exchangeratesapi.io',
        ]);
    }

    private function getLatestRates() {
        try {
            $response = $this->client->get('/latest');
            $data = json_decode($response->getBody()->getContents(), true);
            return $data['rates'] ?? [];
        }
        catch (GuzzleException $e) {
            throw new \RuntimeException('Failed to fetch exchange rates: ' . $e->getMessage());
        }
    }

    #[\Override]
    public function getCurrencyRate(string $currency): float {
        $rates = $this->getLatestRates();
        return $rates[$currency] ?? 0;
    }
}