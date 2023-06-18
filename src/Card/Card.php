<?php

namespace AlbanDurand\Snap\Card;

use AlbanDurand\Snap\Card\Face\Face;
use AlbanDurand\Snap\Card\Suit\Suit;

class Card
{
    public function __construct(
        public readonly Suit $suit,
        public readonly Face $face
    ) {}
}