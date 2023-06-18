<?php

namespace AlbanDurand\Snap\Player;

use AlbanDurand\Snap\Card\CardStack\CardStackInterface;

class Player
{
    public function __construct(
        private readonly int $number,
        private readonly CardStackInterface $hand
    ) {}

    public function hasCards(): bool
    {
        return $this->hand->isEmpty() === false;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getHand(): CardStackInterface
    {
        return $this->hand;
    }
}