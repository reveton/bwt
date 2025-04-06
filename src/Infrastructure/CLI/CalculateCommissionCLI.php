<?php

namespace App\Infrastructure\CLI;

use App\Application\CommandHandlers\CalculateCommissionCommandHandler;
use App\Application\Commands\CalculateCommissionCommand;
use App\Domain\Interfaces\ShowResultInterface;

class CalculateCommissionCLI
{
    public function __construct(
        protected CalculateCommissionCommandHandler $handler,
        protected ShowResultInterface $result
    ) {}

    public function run() {
        try {
            global $argv;
            $filePath = $argv[1];
            $command = new CalculateCommissionCommand(
                filePath: $filePath
            );
            $commissions = $this->handler->execute($command);
            $this->result->showResult($commissions);
        }
        catch (\Exception $e) {
            print "Error: ".$e->getMessage();
        }
    }
}