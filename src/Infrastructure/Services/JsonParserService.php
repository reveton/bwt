<?php

namespace App\Infrastructure\Services;

use App\Application\DTO\TransactionDTO;
use App\Domain\Interfaces\LineParserInterface;

class JsonParserService implements LineParserInterface
{
    #[\Override]
    public function parse(string $line): TransactionDTO
    {
        $data = json_decode($line, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid JSON line: ' . json_last_error_msg());
        }

        return new TransactionDTO(
            bin: $data['bin'],
            amount: $data['amount'],
            currency: $data['currency']
        );
    }
}