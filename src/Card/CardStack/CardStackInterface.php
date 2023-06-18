<?php

namespace AlbanDurand\Snap\Card\CardStack;

use AlbanDurand\Snap\Card\Card;

interface CardStackInterface
{
    public function setCards(Card ...$cards): void;

    /**
     * @return Card[]
     */
    public function getCards(): array;

    public function isEmpty(): bool;
}