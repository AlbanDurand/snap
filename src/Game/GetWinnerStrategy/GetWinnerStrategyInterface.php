<?php

namespace AlbanDurand\Snap\Game\GetWinnerStrategy;

use AlbanDurand\Snap\Game\Game;
use AlbanDurand\Snap\Player\Player;

interface GetWinnerStrategyInterface
{
    public function execute(Game $game): Player;
}