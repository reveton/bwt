<?php

namespace App\Domain\Interfaces;

use App\Application\DTO\TransactionDTO;

interface LineParserInterface
{
    public function parse(string $line) : TransactionDTO;
}