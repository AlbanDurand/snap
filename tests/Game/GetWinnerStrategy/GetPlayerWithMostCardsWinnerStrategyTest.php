<?php

namespace AlbanDurand\Snap\Tests\Game\GetWinnerStrategy;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\CardStack\CardStack;
use AlbanDurand\Snap\Card\CardStack\CardStackInterface;
use AlbanDurand\Snap\Card\Face\Face;
use AlbanDurand\Snap\Card\Suit\Suit;
use AlbanDurand\Snap\Event\EventDispatcher\EventDispatcherInterface;
use AlbanDurand\Snap\Game\Game;
use AlbanDurand\Snap\Game\GameRules\GameRulesInterface;
use AlbanDurand\Snap\Game\GetWinnerStrategy\GetPlayerWithMostCardsWinnerStrategy;
use AlbanDurand\Snap\Player\Player;
use PHPUnit\Framework\TestCase;

class GetPlayerWithMostCardsWinnerStrategyTest extends TestCase
{
    public function testExecute(): void
    {
        $players = [
            new Player(
                0,
                new CardStack(new Card(Suit::Clubs, Face::A))
            ),
            new Player(
                1,
                new CardStack(
                    new Card(Suit::Diamonds, Face::Ten),
                    new Card(Suit::Diamonds, Face::Nine),
                    new Card(Suit::Diamonds, Face::Eight),
                )
            ),
            new Player(
                2,
                new CardStack(
                    new Card(Suit::Diamonds, Face::Ten),
                    new Card(Suit::Hearts, Face::A)
                )
            )
        ];

        $game = new Game(
            $this->createMock(EventDispatcherInterface::class),
            $this->createMock(GameRulesInterface::class),
            $this->createMock(CardStackInterface::class),
            $players
        );

        $strategy = new GetPlayerWithMostCardsWinnerStrategy();

        $winner = $strategy->execute($game);

        $this->assertEquals($players[1], $winner);
    }
}