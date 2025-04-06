<?php

namespace App\Domain\Interfaces;

interface LineReaderInterface
{
    public function read(string $path): iterable;
}