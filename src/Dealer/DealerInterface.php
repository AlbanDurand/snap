<?php

namespace AlbanDurand\Snap\Dealer;

use AlbanDurand\Snap\Card\CardStack\CardStackInterface;
use AlbanDurand\Snap\Player\Player;

interface DealerInterface
{
    /**
     * @param CardStackInterface[] $decks
     * @param Player[] $players
     */
    public function dealCardsOfDecksToPlayers(
        array $decks,
        array $players
    ): void;

    public function shuffle(CardStackInterface $cardStack): void;
}