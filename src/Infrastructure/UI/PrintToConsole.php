<?php

namespace App\Infrastructure\UI;

use App\Domain\Interfaces\ShowResultInterface;

class PrintToConsole implements ShowResultInterface
{
    #[\Override] public function showResult(array $result): void
    {
        foreach ($result as $commission) {
            print $commission."\n";
        }
    }
}