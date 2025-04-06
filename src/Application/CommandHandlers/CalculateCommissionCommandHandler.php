<?php

namespace App\Application\CommandHandlers;

use App\Application\Commands\CalculateCommissionCommand;
use App\Application\UseCases\CalculateTransactionCommission;

class CalculateCommissionCommandHandler
{
    public function __construct(
        protected CalculateTransactionCommission $calculateCommissions
    ) {}

    public function execute(CalculateCommissionCommand $command) : array
    {
        $filePath = $command->getFilePath();

        if (!file_exists($filePath))
            throw new \Exception('File not found');

        return $this->calculateCommissions->execute($filePath);
    }
}