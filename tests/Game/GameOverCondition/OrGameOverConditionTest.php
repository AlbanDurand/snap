<?php

namespace AlbanDurand\Snap\Tests\Game\GameOverCondition;

use AlbanDurand\Snap\Card\CardStack\CardStackInterface;
use AlbanDurand\Snap\Event\EventDispatcher\EventDispatcherInterface;
use AlbanDurand\Snap\Game\Game;
use AlbanDurand\Snap\Game\GameOverCondition\GameOverConditionInterface;
use AlbanDurand\Snap\Game\GameOverCondition\OrGameOverCondition;
use AlbanDurand\Snap\Game\GameRules\GameRulesInterface;
use PHPUnit\Framework\TestCase;

class OrGameOverConditionTest extends TestCase
{
    public function testIsTrue(): void
    {
        $mockedCondition1 = $this->createMock(GameOverConditionInterface::class);
        $mockedCondition1->method('isTrue')->willReturn(true);

        $mockedCondition2 = $this->createMock(GameOverConditionInterface::class);
        $mockedCondition2->method('isTrue')->willReturn(false);

        $condition = new OrGameOverCondition(
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
        $mockedCondition1->method('isTrue')->willReturn(false);

        $mockedCondition2 = $this->createMock(GameOverConditionInterface::class);
        $mockedCondition2->method('isTrue')->willReturn(false);

        $condition = new OrGameOverCondition(
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