<?php

namespace AlbanDurand\Snap\Game\GameOverCondition;

use AlbanDurand\Snap\Game\Game;
use AlbanDurand\Snap\Game\GameOverCondition\GameOverConditionInterface;

class RoundLimitGameOverCondition implements GameOverConditionInterface
{
    public function __construct(
        private readonly int $roundLimit
    ) {}

    public function isTrue(Game $game): bool
    {
        return $game->getRoundNumber() >= $this->roundLimit;
    }
}