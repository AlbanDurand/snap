<?php

namespace AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\CardStack\CardStackInterface;

class AddOnTopOfCardStackStrategy implements AddToCardStackStrategyInterface
{
    /**
     * @param Card[] $cards
     */
    public function execute(CardStackInterface $stack, array $cardsToAdd): void
    {
        $stack->setCards(...$stack->getCards(), ...$cardsToAdd);
    }
}