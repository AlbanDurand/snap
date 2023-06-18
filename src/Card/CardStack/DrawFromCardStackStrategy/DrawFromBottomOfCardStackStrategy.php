<?php

namespace AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy;

use AlbanDurand\Snap\Card\CardStack\CardStackInterface;
use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawFromCardStackStrategyInterface;

class DrawFromBottomOfCardStackStrategy implements DrawFromCardStackStrategyInterface
{
    public function execute(CardStackInterface $cardStack): Card
    {
        $cards = $cardStack->getCards();

        $drawnCard = array_shift($cards);

        $cardStack->setCards(...$cards);

        return $drawnCard;
    }
}