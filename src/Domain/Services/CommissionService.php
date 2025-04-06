<?php

namespace App\Domain\Services;

use App\Domain\Helpers\BinHelper;
use App\Domain\Interfaces\BinServiceAPI;
use App\Domain\Interfaces\CommissionServiceInterface;
use App\Domain\Interfaces\ExchangeRateAPI;

class CommissionService implements CommissionServiceInterface
{
    public function __construct(
        protected BinServiceAPI            $binService,
        protected ExchangeRateAPI $currencyService
    ) {}

    #[\Override] public function calculate(string $bin, float $amount, string $currency): float
    {
        $countryCode = $this->binService->getCountryCode($bin);
        $rate = $this->currencyService->getCurrencyRate($currency);
        $isEu = BinHelper::isEu($countryCode);

        if ($currency == 'EUR' || !$rate)
            $amntFixed = $amount;
        else
            $amntFixed = $amount / $rate;
        $euCoefficient = $isEu ? 0.01 : 0.02;

        return round($amntFixed * $euCoefficient, 2);
    }
}