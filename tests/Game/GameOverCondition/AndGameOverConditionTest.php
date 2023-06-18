<?php

namespace AlbanDurand\Snap\Tests\Game\GameOverCondition;

use AlbanDurand\Snap\Card\CardStack\CardStackInterface;
use AlbanDurand\Snap\Event\EventDispatcher\EventDispatcherInterface;
use AlbanDurand\Snap\Game\Game;
use AlbanDurand\Snap\Game\GameOverCondition\AndGameOverCondition;
use AlbanDurand\Snap\Game\GameOverCondition\GameOverConditionInterface;
use AlbanDurand\Snap\Game\GameRules\GameRulesInterface;
use PHPUnit\Framework\TestCase;

class AndGameOverConditionTest extends TestCase
{
    public function testIsTrue(): void
    {
        $mockedCondition1 = $this->createMock(GameOverConditionInterface::class);
        $mockedCondition1->method('isTrue')->willReturn(true);

        $mockedCondition2 = $this->createMock(GameOverConditionInterface::class);
        $mockedCondition2->method('isTrue')->willReturn(true);

        $condition = new AndGameOverCondition(
            $mockedCondition1,
            $mockedCondition2
        );

        $game = new Game(
            $this->createMock(EventDispatcherInterface::class),
            $this->createMock(GameRulesInterface::class),
            $this->createMock(CardStackInterface::class),
            []
        );

        $this->assertTrue($condition->isTrue($game));
    }

    public function testIsFalse(): void
    {
        $mockedCondition1 = $this->createMock(GameOverConditionInterface::class);
        $mockedCondition1->method('isTrue')->willReturn(true);

        $mockedCondition2 = $this->createMock(GameOverConditionInterface::class);
        $mockedCondition2->method('isTrue')->willReturn(false);

        $condition = new AndGameOverCondition(
            $mockedCondition1,
            $mockedCondition2
        );

        $game = new Game(
            $this->createMock(EventDispatcherInterface::class),
            $this->createMock(GameRulesInterface::class),
            $this->createMock(CardStackInterface::class),
            []
        );

        $this->assertFalse($condition->isTrue($game));
    }
}