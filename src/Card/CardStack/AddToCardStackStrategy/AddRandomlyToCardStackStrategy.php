<?php

namespace AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\CardStack\CardStackInterface;

class AddRandomlyToCardStackStrategy implements AddToCardStackStrategyInterface
{
    /**
     * @param Card[] $cards
     */
    public function execute(CardStackInterface $stack, array $cardsToAdd): void
    {
        $nextCards = $stack->getCards();

        while ($cardsToAdd !== []) {
            array_splice(
                $nextCards,
                mt_rand(0, count($nextCards)),
                0,
                [array_pop($cardsToAdd)]
            );
        }

        $stack->setCards(...$nextCards);
    }
}