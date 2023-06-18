<?php

namespace AlbanDurand\Snap\Game\GameRules;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddToCardStackStrategyInterface;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawFromCardStackStrategyInterface;
use AlbanDurand\Snap\Game\Game;
use AlbanDurand\Snap\Game\GameOverCondition\GameOverConditionInterface;
use AlbanDurand\Snap\Game\GetWinnerStrategy\GetWinnerStrategyInterface;
use AlbanDurand\Snap\Game\MatchingCardsCondition\MatchingCardsConditionInterface;
use AlbanDurand\Snap\Player\Player;

class GameRules implements GameRulesInterface
{
    public function __construct(
        private readonly GameOverConditionInterface $gameOverCondition,
        private readonly AddToCardStackStrategyInterface $addCardsToPlayerHandStrategy,
        private readonly DrawFromCardStackStrategyInterface $drawCardFromPlayerHandStrategy,
        private readonly MatchingCardsConditionInterface $matchingCardsCondition,
        private readonly GetWinnerStrategyInterface $getWinnerStrategy
    ) {}

    public function isGameOver(Game $game): bool
    {
        return $this->gameOverCondition->isTrue($game);
    }

    public function addCardsToPlayerHand(
        Player $player,
        array $cardsToAdd
    ): void {
        $this->addCardsToPlayerHandStrategy->execute(
            $player->getHand(),
            $cardsToAdd
        );
    }

    public function drawCardFromPlayerHand(Player $player): Card
    {
        return $this->drawCardFromPlayerHandStrategy->execute($player->getHand());
    }

    public function areCardsMatching(Card $a, Card $b): bool
    {
        return $this->matchingCardsCondition->isTrue($a, $b);
    }

    public function getWinner(Game $game): Player
    {
        return $this->getWinnerStrategy->execute($game);
    }
}