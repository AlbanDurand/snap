<?php

namespace AlbanDurand\Snap\Game\GameOverCondition;

use AlbanDurand\Snap\Game\Game;

interface GameOverConditionInterface
{
    public function isTrue(Game $game): bool;
}