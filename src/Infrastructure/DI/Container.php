<?php
use App\Infrastructure\Services\FileReaderService;
use DI\ContainerBuilder;


$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    \App\Infrastructure\Handlers\CalculateCommissionCommandHandler::class => DI\autowire(),
    \App\Application\UseCases\CalculateTransactionCommission::class => DI\autowire(),
    \App\Domain\Interfaces\LineReaderInterface::class => DI\autowire(FileReaderService::class),
    \App\Domain\Interfaces\LineParserInterface::class => DI\autowire(\App\Infrastructure\Services\JsonParserService::class),
    \App\Domain\Interfaces\CommissionServiceInterface::class => DI\autowire(\App\Domain\Services\CommissionService::class),
    \App\Domain\Interfaces\BinServiceAPI::class => DI\autowire(\App\Infrastructure\API\BinCheckerAPI::class),
    \App\Domain\Interfaces\ExchangeRateAPI::class => DI\autowire(\App\Infrastructure\API\ExchangeRatesAPI::class),
    \App\Domain\Interfaces\ShowResultInterface::class => DI\autowire(\App\Infrastructure\UI\PrintToConsole::class)
]);


$container = $containerBuilder->build();