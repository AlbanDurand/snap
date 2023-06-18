<?php

namespace AlbanDurand\Snap\Game\GameOverCondition;

use AlbanDurand\Snap\Game\Game;

class AtLeastOneEmptyHandGameOverCondition implements GameOverConditionInterface
{
    public function isTrue(Game $game): bool
    {
        foreach ($game->getPlayers() as $player) {
            if ($player->hasCards() === false) {
                return true;
            }
        }

        return false;
    }
}