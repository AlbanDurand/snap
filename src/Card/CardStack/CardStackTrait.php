<?php

namespace AlbanDurand\Snap\Card\CardStack;

use AlbanDurand\Snap\Card\Card;

trait CardStackTrait
{
    /**
     * @var Card[] $cards
     */
    private array $cards;

    public function setCards(Card ...$cards): void
    {
        $this->cards = $cards;
    }

    /**
     * @return Card[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    public function isEmpty(): bool
    {
        return $this->cards === [];
    }
}