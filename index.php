<?php

require __DIR__.'/vendor/autoload.php';

require_once __DIR__ . '/src/Infrastructure/DI/Container.php';

$app = $container->get(\App\Infrastructure\CLI\CalculateCommissionCLI::class);

$app->run();