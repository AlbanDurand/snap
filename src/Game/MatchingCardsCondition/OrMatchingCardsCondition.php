<?php

namespace AlbanDurand\Snap\Game\MatchingCardsCondition;

use AlbanDurand\Snap\Card\Card;

class OrMatchingCardsCondition extends AbstractLogicalMatchingCardsCondition
{
    public function isTrue(Card $a, Card $b): bool
    {
        foreach ($this->conditions as $condition) {
            if ($condition->isTrue($a, $b)) {
                return true;
            }
        }

        return false;
    }
}