<?php

namespace AlbanDurand\Snap\Game\MatchingCardsCondition;

use AlbanDurand\Snap\Card\Card;

class AndMatchingCardsCondition extends AbstractLogicalMatchingCardsCondition
{
    public function isTrue(Card $a, Card $b): bool
    {
        foreach ($this->conditions as $condition) {
            if ($condition->isTrue($a, $b) === false) {
                return false;
            }
        }

        return true;
    }
}