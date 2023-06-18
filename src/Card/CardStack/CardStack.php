<?php

namespace AlbanDurand\Snap\Card\CardStack;

use AlbanDurand\Snap\Card\Card;

class CardStack implements CardStackInterface
{
    use CardStackTrait;

    public function __construct(Card ...$cards)
    {
        $this->cards = $cards;
    }
}