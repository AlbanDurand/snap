<?php

namespace AlbanDurand\Snap\Game\GetWinnerStrategy;

use AlbanDurand\Snap\Game\Game;
use AlbanDurand\Snap\Player\Player;

class GetPlayerWithMostCardsWinnerStrategy implements GetWinnerStrategyInterface
{
    public function execute(Game $game): Player
    {
        $players = $game->getPlayers();

        usort($players, function (Player $a, Player $b) {
            return count($b->getHand()->getCards()) - count($a->getHand()->getCards());
        });

        return array_shift($players);
    }
}