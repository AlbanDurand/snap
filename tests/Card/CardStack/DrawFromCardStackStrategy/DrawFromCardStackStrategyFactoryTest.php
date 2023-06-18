<?php

namespace AlbanDurand\Snap\Tests\Card\CardStack\DrawFromCardStackStrategy;

use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawFromBottomOfCardStackStrategy;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawFromCardStackStrategyFactory;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawFromCardStackStrategyFactoryException;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawFromTopOfCardStackStrategy;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawRandomlyFromCardStackStrategy;
use PHPUnit\Framework\TestCase;

class DrawFromCardStackStrategyFactoryTest extends TestCase
{
    /**
     * @dataProvider createFromStringProvider
     */
    public function testCreateFromString(
        string $strategyName,
        string $strategyClass
    ): void {
        $factory = new DrawFromCardStackStrategyFactory();

        $strategy = $factory->createFromString($strategyName);

        $this->assertInstanceOf($strategyClass, $strategy);
    }

    public function createFromStringProvider(): array
    {
        return [
            ['top', DrawFromTopOfCardStackStrategy::class],
            ['bottom', DrawFromBottomOfCardStackStrategy::class],
            ['random', DrawRandomlyFromCardStackStrategy::class]
        ];
    }

    public function testCreateFromStringThrowsExceptionWithUnknownString(): void
    {
        $factory = new DrawFromCardStackStrategyFactory();

        $this->expectException(DrawFromCardStackStrategyFactoryException::class);

        $factory->createFromString('...');
    }
}