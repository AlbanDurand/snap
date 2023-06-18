<?php

namespace AlbanDurand\Snap\Game\GameOverCondition;

use AlbanDurand\Snap\Game\Game;

class OrGameOverCondition extends AbstractLogicalGameOverCondition
{
    public function isTrue(Game $game): bool
    {
        foreach ($this->conditions as $condition) {
            if ($condition->isTrue($game)) {
                return true;
            }
        }

        return false;
    }
}