<?php

namespace App\Application\UseCases;

use App\Domain\Interfaces\CommissionServiceInterface;
use App\Domain\Interfaces\LineParserInterface;
use App\Domain\Interfaces\LineReaderInterface;

class CalculateTransactionCommission
{
    public function __construct(
        protected LineReaderInterface $lineReader,
        protected LineParserInterface $lineParser,
        protected CommissionServiceInterface $commissionService
    ) {}

    public function execute(string $filePath) : array
    {
        $commissions = [];
        foreach ($this->lineReader->read($filePath) as $line) {
            $transactionDTO = $this->lineParser->parse($line);
            $commission = $this->commissionService->calculate(
                bin: $transactionDTO->bin,
                amount: $transactionDTO->amount,
                currency: $transactionDTO->currency
            );
            $commissions[] = $commission;
        }
        return $commissions;
    }
}