<?php

namespace AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy;

use AlbanDurand\Snap\Card\CardStack\CardStackInterface;
use AlbanDurand\Snap\Card\Card;

interface AddToCardStackStrategyInterface
{
    /**
     * @param Card[] $cards
     */
    public function execute(CardStackInterface $stack, array $cardsToAdd): void;
}