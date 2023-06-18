<?php

namespace AlbanDurand\Snap\Event;

use AlbanDurand\Snap\Card\Card;

class TurnPlayedEvent
{
    public function __construct(
        public readonly int $roundNumber,
        public readonly int $turnNumber,
        public readonly int $playerNumber,
        public readonly Card $drawnCard,
        public readonly ?Card $cardOnTable
    ) {}
}