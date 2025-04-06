<?php

namespace App\Infrastructure\Services;

use App\Domain\Interfaces\LineReaderInterface;

class FileReaderService implements LineReaderInterface
{
    #[\Override]
    public function read(string $path): iterable
    {
        $handle = fopen($path, 'r');

        if (!$handle) {
            throw new \RuntimeException("Unable to open file: $path");
        }

        while (($line = fgets($handle)) !== false) {
            $trimmed = trim($line);
            if ($trimmed !== '') {
                yield $trimmed;
            }
        }

        fclose($handle);
    }
}