<?php

namespace App\Domain\Interfaces;

interface ExchangeRateAPI
{
    public function getCurrencyRate(string $currency): float;
}