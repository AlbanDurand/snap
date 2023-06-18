<?php

namespace AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy;

use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddOnTopOfCardStackStrategy;
use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddRandomlyToCardStackStrategy;
use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddToBottomOfCardStackStrategy;
use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddToCardStackStrategyInterface;

class AddToCardStackStrategyFactory
{
    public function createFromString(string $strategy): AddToCardStackStrategyInterface
    {
        switch ($strategy) {
            case 'top':
                return new AddOnTopOfCardStackStrategy();

            case 'bottom':
                return new AddToBottomOfCardStackStrategy();

            case 'random':
                return new AddRandomlyToCardStackStrategy();

            default:
                throw new AddToCardStackStrategyFactoryException(
                    sprintf(
                        '%s does not handle the string "%s".',
                        self::class,
                        $strategy
                    )
                );
        }
    }
}