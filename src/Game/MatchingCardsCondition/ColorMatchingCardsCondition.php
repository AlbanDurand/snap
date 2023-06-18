<?php

namespace AlbanDurand\Snap\Game\MatchingCardsCondition;

use AlbanDurand\Snap\Card\Card;

class ColorMatchingCardsCondition implements MatchingCardsConditionInterface
{
    public function isTrue(Card $a, Card $b): bool
    {
        return $a->suit->getColor() === $b->suit->getColor();
    }
}