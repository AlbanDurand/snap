<?php

namespace AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy;

use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawFromCardStackStrategyInterface;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawFromBottomOfCardStackStrategy;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawFromTopOfCardStackStrategy;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawRandomlyFromCardStackStrategy;

class DrawFromCardStackStrategyFactory
{
    public function createFromString(string $strategy): DrawFromCardStackStrategyInterface
    {
        switch ($strategy) {
            case 'top':
                return new DrawFromTopOfCardStackStrategy();

            case 'bottom':
                return new DrawFromBottomOfCardStackStrategy();

            case 'random':
                return new DrawRandomlyFromCardStackStrategy();

            default:
                throw new DrawFromCardStackStrategyFactoryException(
                    sprintf(
                        '%s does not handle the string "%s".',
                        self::class,
                        $strategy
                    )
                );
        }
    }
}