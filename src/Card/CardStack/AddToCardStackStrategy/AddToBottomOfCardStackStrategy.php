<?php

namespace AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy;

use AlbanDurand\Snap\Card\CardStack\CardStackInterface;

class AddToBottomOfCardStackStrategy implements AddToCardStackStrategyInterface
{
    public function execute(CardStackInterface $stack, array $cardsToAdd): void
    {
        $stack->setCards(...$cardsToAdd, ...$stack->getCards());
    }
}