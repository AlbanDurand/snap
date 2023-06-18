<?php

namespace AlbanDurand\Snap\Game\GameOverCondition;

use AlbanDurand\Snap\Game\Game;

class AndGameOverCondition extends AbstractLogicalGameOverCondition
{
    public function isTrue(Game $game): bool
    {
        foreach ($this->conditions as $condition) {
            if ($condition->isTrue($game) === false) {
                return false;
            }
        }

        return true;
    }
}