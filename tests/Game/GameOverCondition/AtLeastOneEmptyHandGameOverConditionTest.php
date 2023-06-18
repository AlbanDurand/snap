<?php

namespace AlbanDurand\Snap\Tests\Game\GameOverCondition;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddOnTopOfCardStackStrategy;
use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddToBottomOfCardStackStrategy;
use AlbanDurand\Snap\Card\CardStack\CardStack;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawFromTopOfCardStackStrategy;
use AlbanDurand\Snap\Card\Face\Face;
use AlbanDurand\Snap\Card\Suit\Suit;
use AlbanDurand\Snap\Event\EventDispatcher\EventDispatcher;
use AlbanDurand\Snap\Game\Game;
use AlbanDurand\Snap\Game\GameOverCondition\AtLeastOneEmptyHandGameOverCondition;
use AlbanDurand\Snap\Game\GameRules\GameRules;
use AlbanDurand\Snap\Game\GetWinnerStrategy\GetPlayerWithMostCardsWinnerStrategy;
use AlbanDurand\Snap\Game\MatchingCardsCondition\FaceMatchingCardsCondition;
use AlbanDurand\Snap\Player\Player;
use PHPUnit\Framework\TestCase;

class AtLeastOneEmptyHandGameOverConditionTest extends TestCase
{
    public function testIsTrue(): void
    {
        $condition = new AtLeastOneEmptyHandGameOverCondition();

        $game = new Game(
            new EventDispatcher(),
            new GameRules(
                new AtLeastOneEmptyHandGameOverCondition(),
                new AddToBottomOfCardStackStrategy(),
                new DrawFromTopOfCardStackStrategy(),
                new FaceMatchingCardsCondition(),
                new GetPlayerWithMostCardsWinnerStrategy()
            ),
            new CardStack(),
            [
                new Player(0, new CardStack(new Card(Suit::Clubs, Face::A))),
                new Player(1, new CardStack())
            ]
        );

        $this->assertTrue($condition->isTrue($game));
    }

    public function testIsFalse(): void
    {
        $condition = new AtLeastOneEmptyHandGameOverCondition();

        $game = new Game(
            new EventDispatcher(),
            new GameRules(
                $condition,
                new AddToBottomOfCardStackStrategy(),
                new DrawFromTopOfCardStackStrategy(),
                new FaceMatchingCardsCondition(),
                new GetPlayerWithMostCardsWinnerStrategy()
            ),
            new CardStack(),
            [
                new Player(0, new CardStack(new Card(Suit::Clubs, Face::A))),
                new Player(1, new CardStack(new Card(Suit::Diamonds, Face::Ten)))
            ]
        );

        $this->assertFalse($condition->isTrue($game));
    }
}