<?php

namespace AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy;

use AlbanDurand\Snap\Card\CardStack\CardStackInterface;
use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawFromCardStackStrategyInterface;

class DrawRandomlyFromCardStackStrategy implements DrawFromCardStackStrategyInterface
{
    public function execute(CardStackInterface $cardStack): Card
    {
        $cards = $cardStack->getCards();
        $cardToDrawRandomIndex = mt_rand(0, count($cards) - 1);
        $drawnCard = array_splice($cards, $cardToDrawRandomIndex, 1)[0];
        $cardStack->setCards(...$cards);

        return $drawnCard;
    }
}