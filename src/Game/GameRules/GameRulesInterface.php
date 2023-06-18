<?php

namespace AlbanDurand\Snap\Game\GameRules;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Game\Game;
use AlbanDurand\Snap\Player\Player;

interface GameRulesInterface
{
    public function isGameOver(Game $game): bool;

    public function drawCardFromPlayerHand(Player $player): Card;

    /**
     * @param Card[] $cards
     */
    public function addCardsToPlayerHand(Player $player, array $cardsToAdd): void;

    public function areCardsMatching(Card $a, Card $b): bool;

    public function getWinner(Game $game): Player;
}