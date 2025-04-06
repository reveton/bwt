<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Domain\Services\CommissionService;
use App\Domain\Interfaces\BinServiceAPI;
use App\Domain\Interfaces\ExchangeRateAPI;

class CalculateCommissionTest extends TestCase
{
    private $binService;
    private $currencyService;
    private $commissionService;

    protected function setUp(): void
    {
        $this->binService = $this->createMock(BinServiceAPI::class);
        $this->currencyService = $this->createMock(ExchangeRateAPI::class);
        $this->commissionService = new CommissionService(
            $this->binService,
            $this->currencyService
        );
    }

    public function testCalculateCommissionForEurCurrency()
    {
        $this->binService
            ->expects($this->once())
            ->method('getCountryCode')
            ->willReturn('DE');

        $this->currencyService
            ->expects($this->once())
            ->method('getCurrencyRate')
            ->willReturn(1.2);

        $commission = $this->commissionService->calculate('411111', 1000, 'EUR');

        $this->assertEquals(10.00, $commission);
    }

    public function testCalculateCommissionForNonEuCountry()
    {
        $this->binService
            ->expects($this->once())
            ->method('getCountryCode')
            ->willReturn('US');

        $this->currencyService
            ->expects($this->once())
            ->method('getCurrencyRate')
            ->willReturn(1.2);

        $commission = $this->commissionService->calculate('411111', 1000, 'USD');

        $this->assertEquals(16.67, $commission);
    }
}