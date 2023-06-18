<?php

namespace AlbanDurand\Snap\Tests\Game\MatchingCardsCondition;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\Face\Face;
use AlbanDurand\Snap\Card\Suit\Suit;
use AlbanDurand\Snap\Game\MatchingCardsCondition\AndMatchingCardsCondition;
use AlbanDurand\Snap\Game\MatchingCardsCondition\FaceMatchingCardsCondition;
use AlbanDurand\Snap\Game\MatchingCardsCondition\SuitMatchingCardsCondition;
use PHPUnit\Framework\TestCase;

class AndMatchingCardsConditionTest extends TestCase
{
    public function testIsTrue(): void
    {
        $condition = new AndMatchingCardsCondition(
            new SuitMatchingCardsCondition(),
            new FaceMatchingCardsCondition()
        );

        $this->assertTrue(
            $condition->isTrue(
                new Card(Suit::Hearts, Face::Two),
                new Card(Suit::Hearts, Face::Two)
            )
        );
    }

    public function testIsFalse(): void
    {
        $condition = new AndMatchingCardsCondition(
            new SuitMatchingCardsCondition(),
            new FaceMatchingCardsCondition()
        );

        $this->assertFalse(
            $condition->isTrue(
                new Card(Suit::Hearts, Face::Two),
                new Card(Suit::Hearts, Face::Three)
            )
        );
    }
}