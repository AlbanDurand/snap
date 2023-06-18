<?php

namespace AlbanDurand\Snap\Game;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\CardStack\CardStackInterface;
use AlbanDurand\Snap\Event\EventDispatcher\EventDispatcherInterface;
use AlbanDurand\Snap\Event\TurnPlayedEvent;
use AlbanDurand\Snap\Event\TurnWonEvent;
use AlbanDurand\Snap\Game\GameRules\GameRulesInterface;
use AlbanDurand\Snap\Player\Player;

class Game
{
    /** @var Player[] $players */
    private readonly array $players;
    private readonly GameRulesInterface $rules;
    private readonly CardStackInterface $table;
    private readonly EventDispatcherInterface $eventDispatcher;
    private int $turnNumber;

    /**
     * @param Player[] $players
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        GameRulesInterface $rules,
        CardStackInterface $table,
        array $players
    ) {
        $this->rules = $rules;
        $this->table = $table;
        $this->eventDispatcher = $eventDispatcher;
        $this->players = $players;
        $this->turnNumber = 0;
    }

    public function playNextTurn(): void
    {
        $player = $this->getActivePlayer();
        $drawnCard = $this->rules->drawCardFromPlayerHand($player);

        $this->eventDispatcher->dispatch(
            new TurnPlayedEvent(
                $this->getRoundNumber(),
                $this->turnNumber,
                $player->getNumber(),
                $drawnCard,
                $this->getFirstCardOnTable()
            )
        );

        $this->addCardToTable($drawnCard);

        if ($this->areFirstTwoCardsOnTableMatching()) {
            $this->activePlayerWinsTurn();
        }

        $this->turnNumber++;
    }

    private function getNthCardOnTable(int $cardIndex): ?Card
    {
        $cardsOnTable = $this->table->getCards();
        $cardsOnTableCount = count($cardsOnTable);

        return $cardIndex < $cardsOnTableCount
            ? $cardsOnTable[$cardsOnTableCount - $cardIndex - 1]
            : null;
    }

    private function getFirstCardOnTable(): ?Card
    {
        return $this->getNthCardOnTable(0);
    }

    private function getSecondCardOnTable(): ?Card
    {
        return $this->getNthCardOnTable(1);
    }

    private function activePlayerWinsTurn()
    {
        $matchingCard = $this->getFirstCardOnTable();
        $drawnCard = $this->getSecondCardOnTable();
        $activePlayer = $this->getActivePlayer();

        $this->playerTakesCardsOnTable($activePlayer);

        $this->eventDispatcher->dispatch(
            new TurnWonEvent(
                $this->getRoundNumber(),
                $this->turnNumber,
                $activePlayer->getNumber(),
                $drawnCard,
                $matchingCard
            )
        );
    }

    /**
     * @return Player[]
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    public function getWinner(): Player
    {
        if ($this->isOver() === false) {
            throw new GameException(
                'It is not possible to get the winner before the game is over.'
            );
        }

        return $this->rules->getWinner($this);
    }

    /**
     * Returns the current round of table number, starting from 0
     */
    public function getRoundNumber(): int
    {
        return (int) ($this->turnNumber / count($this->players));
    }

    public function isOver(): bool
    {
        return $this->rules->isGameOver($this);
    }

    private function addCardToTable(Card $card): void
    {
        $this->table->setCards(...[...$this->table->getCards(), $card]);
    }

    private function playerTakesCardsOnTable(Player $player)
    {
        // As the cards on the table are faced up unlike cards in players' hands,
        // we reverse them before adding them to the active player's hand
        $this->rules->addCardsToPlayerHand(
            $player,
            array_reverse($this->table->getCards())
        );

        $this->table->setCards(...[]);
    }

    private function areFirstTwoCardsOnTableMatching(): bool
    {
        $firstCard = $this->getFirstCardOnTable();
        $secondCard = $this->getSecondCardOnTable();

        return $firstCard !== null
            && $secondCard !== null
            && $this->rules->areCardsMatching($firstCard, $secondCard);
    }

    /**
     * Returns the player whose turn it is
     */
    private function getActivePlayer(): Player
    {
        return $this->players[$this->turnNumber % count($this->players)];
    }
}