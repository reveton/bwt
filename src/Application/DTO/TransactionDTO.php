<?php

namespace App\Application\DTO;

class TransactionDTO
{
    public function __construct(
        public string $bin,
        public float $amount,
        public string $currency
    ) {}
}