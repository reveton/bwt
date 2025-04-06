<?php

namespace App\Domain\Interfaces;

interface BinServiceAPI
{
    public function getCountryCode(string $bin): string;
}