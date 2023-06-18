<?php

namespace AlbanDurand\Snap\Tests\Game\GameOverCondition;

use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddOnTopOfCardStackStrategy;
use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddToBottomOfCardStackStrategy;
use AlbanDurand\Snap\Card\CardStack\CardStack;
use AlbanDurand\Snap\Card\CardStack\CardStackBuilder;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawFromTopOfCardStackStrategy;
use AlbanDurand\Snap\Card\Face\Face;
use AlbanDurand\Snap\Card\Suit\Suit;
use AlbanDurand\Snap\Dealer\Dealer;
use AlbanDurand\Snap\Event\EventDispatcher\EventDispatcher;
use AlbanDurand\Snap\Game\Game;
use AlbanDurand\Snap\Game\GameOverCondition\RoundLimitGameOverCondition;
use AlbanDurand\Snap\Game\GameRules\GameRules;
use AlbanDurand\Snap\Game\GetWinnerStrategy\GetPlayerWithMostCardsWinnerStrategy;
use AlbanDurand\Snap\Game\MatchingCardsCondition\FaceMatchingCardsCondition;
use AlbanDurand\Snap\Player\Player;
use PHPUnit\Framework\TestCase;

class RoundLimitGameOverConditionTest extends TestCase
{
    public function testIsTrue(): void
    {
        $dealer = new Dealer(
            new DrawFromTopOfCardStackStrategy(),
            new AddOnTopOfCardStackStrategy()
        );

        $players = [
            new Player(0, new CardStack()),
            new Player(1, new CardStack())
        ];

        // We build a deck of 52 cards
        $deck = (new CardStackBuilder())
            ->withSuits(...Suit::cases())
            ->withFaces(...Face::cases())
            ->buildCardStack();

        // Each player is given 26 cards to make sure we can test the round limit
        $dealer->dealCardsOfDecksToPlayers([$deck], $players);

        $condition = new RoundLimitGameOverCondition(5);

        $game = new Game(
            new EventDispatcher(),
            new GameRules(
                $condition,
                new AddToBottomOfCardStackStrategy(),
                new DrawFromTopOfCardStackStrategy(),
                new FaceMatchingCardsCondition(),
                new GetPlayerWithMostCardsWinnerStrategy()
            ),
            $deck,
            $players
        );

        $game->playNextTurn();
        $game->playNextTurn();
        $game->playNextTurn();
        $game->playNextTurn();
        $game->playNextTurn();
        $game->playNextTurn();
        $game->playNextTurn();
        $game->playNextTurn();
        $game->playNextTurn();

        $this->assertFalse($condition->isTrue($game));

        $game->playNextTurn();

        $this->assertTrue($condition->isTrue($game));
    }
}