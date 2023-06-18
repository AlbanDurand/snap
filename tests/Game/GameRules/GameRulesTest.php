<?php

namespace AlbanDurand\Snap\Tests\Game\GameRules;

use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddToCardStackStrategyInterface;
use AlbanDurand\Snap\Card\CardStack\CardStackInterface;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawFromCardStackStrategyInterface;
use AlbanDurand\Snap\Event\EventDispatcher\EventDispatcherInterface;
use AlbanDurand\Snap\Game\Game;
use AlbanDurand\Snap\Game\GameOverCondition\GameOverConditionInterface;
use AlbanDurand\Snap\Game\GameRules\GameRules;
use AlbanDurand\Snap\Game\GameRules\GameRulesInterface;
use AlbanDurand\Snap\Game\GetWinnerStrategy\GetWinnerStrategyInterface;
use AlbanDurand\Snap\Game\MatchingCardsCondition\MatchingCardsConditionInterface;
use PHPUnit\Framework\TestCase;

class GameRulesTest extends TestCase
{
    public function testIsGameOver(): void
    {
        $gameOverCondition = $this->createMock(GameOverConditionInterface::class);
        $gameOverCondition->method('isTrue')->willReturn(true);

        $rules = new GameRules(
            $gameOverCondition,
            $this->createMock(AddToCardStackStrategyInterface::class),
            $this->createMock(DrawFromCardStackStrategyInterface::class),
            $this->createMock(MatchingCardsConditionInterface::class),
            $this->createMock(GetWinnerStrategyInterface::class)
        );

        $game = new Game(
            $this->createMock(EventDispatcherInterface::class),
            $this->createMock(GameRulesInterface::class),
            $this->createMock(CardStackInterface::class),
            []
        );

        $this->assertTrue($rules->isGameOver($game));
    }

    public function testIsGameNotOver(): void
    {
        $gameOverCondition = $this->createMock(GameOverConditionInterface::class);
        $gameOverCondition->method('isTrue')->willReturn(false);

        $rules = new GameRules(
            $gameOverCondition,
            $this->createMock(AddToCardStackStrategyInterface::class),
            $this->createMock(DrawFromCardStackStrategyInterface::class),
            $this->createMock(MatchingCardsConditionInterface::class),
            $this->createMock(GetWinnerStrategyInterface::class)
        );

        $game = new Game(
            $this->createMock(EventDispatcherInterface::class),
            $this->createMock(GameRulesInterface::class),
            $this->createMock(CardStackInterface::class),
            []
        );

        $this->assertFalse($rules->isGameOver($game));
    }
}