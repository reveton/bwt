<?php

namespace App\Domain\Interfaces;

interface CommissionServiceInterface
{
    public function calculate(string $bin, float $amount, string $currency): float;
}