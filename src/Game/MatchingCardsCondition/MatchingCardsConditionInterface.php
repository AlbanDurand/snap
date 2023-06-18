<?php

namespace AlbanDurand\Snap\Game\MatchingCardsCondition;

use AlbanDurand\Snap\Card\Card;

interface MatchingCardsConditionInterface
{
    public function isTrue(Card $a, Card $b): bool;
}