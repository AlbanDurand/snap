<?php

namespace AlbanDurand\Snap\Game\MatchingCardsCondition;

use AlbanDurand\Snap\Card\Card;

class SuitMatchingCardsCondition implements MatchingCardsConditionInterface
{
    public function isTrue(Card $a, Card $b): bool
    {
        return $a->suit === $b->suit;
    }
}