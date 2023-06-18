<?php

namespace AlbanDurand\Snap\Tests\Card\CardStack\AddToCardStackStrategy;

use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddOnTopOfCardStackStrategy;
use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddRandomlyToCardStackStrategy;
use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddToBottomOfCardStackStrategy;
use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddToCardStackStrategyFactory;
use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddToCardStackStrategyFactoryException;
use PHPUnit\Framework\TestCase;

class AddToCardStackStrategyFactoryTest extends TestCase
{
    /**
     * @dataProvider createFromStringProvider
     */
    public function testCreateFromString(
        string $strategyName,
        string $strategyClass
    ): void {
        $factory = new AddToCardStackStrategyFactory();

        $strategy = $factory->createFromString($strategyName);

        $this->assertInstanceOf($strategyClass, $strategy);
    }

    public function createFromStringProvider(): array
    {
        return [
            ['top', AddOnTopOfCardStackStrategy::class],
            ['bottom', AddToBottomOfCardStackStrategy::class],
            ['random', AddRandomlyToCardStackStrategy::class]
        ];
    }

    public function testCreateFromStringThrowsExceptionWithUnknownString(): void
    {
        $factory = new AddToCardStackStrategyFactory();

        $this->expectException(AddToCardStackStrategyFactoryException::class);

        $factory->createFromString('...');
    }
}