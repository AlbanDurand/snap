<?php

namespace AlbanDurand\Snap\Card\CardStack;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\Face\Face;
use AlbanDurand\Snap\Card\Suit\Suit;

class CardStackBuilder
{
    /**
     * @var Suit[]
     */
    private array $suits;

    /**
     * @var Face[]
     */
    private array $faces;

    public function __construct()
    {
        $this->reset();
    }

    public function withSuits(Suit ...$suits): self
    {
        $this->suits = $suits;

        return $this;
    }

    public function withFaces(Face ...$faces): self
    {
        $this->faces = $faces;

        return $this;
    }

    public function buildCardStack(): CardStackInterface
    {
        $cards = array_reduce(
            $this->suits,
            function (array $cards, Suit $suit): array {
                return [
                    ...$cards,
                    ...$this->buildCardsSuit($suit, $this->faces)
                ];
            },
            []
        );

        $cardStack = new CardStack(...$cards);

        $this->reset();

        return $cardStack;
    }

    /**
     * @param Face[] $faces
     *
     * @return Card[]
     */
    private function buildCardsSuit(Suit $suit, array $faces): array
    {
        return array_map(
            function (Face $face) use ($suit): Card {
                return new Card($suit, $face);
            },
            $faces
        );
    }

    private function reset(): void
    {
        $this->suits = [];
        $this->faces = [];
    }
}