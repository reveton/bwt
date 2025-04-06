<?php

namespace App\Application\Commands;

class CalculateCommissionCommand
{
    public function __construct(
        protected string $filePath
    ) {}

    public function getFilePath(): string
    {
        return $this->filePath;
    }
}