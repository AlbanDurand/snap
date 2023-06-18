<?php

namespace AlbanDurand\Snap\Game\MatchingCardsCondition;

use AlbanDurand\Snap\Card\Card;

class FaceMatchingCardsCondition implements MatchingCardsConditionInterface
{
    public function isTrue(Card $a, Card $b): bool
    {
        return $a->face === $b->face;
    }
}