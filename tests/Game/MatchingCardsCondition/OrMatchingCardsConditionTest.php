<?php

namespace AlbanDurand\Snap\Tests\Game\MatchingCardsCondition;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\Face\Face;
use AlbanDurand\Snap\Card\Suit\Suit;
use AlbanDurand\Snap\Game\MatchingCardsCondition\FaceMatchingCardsCondition;
use AlbanDurand\Snap\Game\MatchingCardsCondition\OrMatchingCardsCondition;
use AlbanDurand\Snap\Game\MatchingCardsCondition\SuitMatchingCardsCondition;
use PHPUnit\Framework\TestCase;

class OrMatchingCardsConditionTest extends TestCase
{
    public function testIsTrue(): void
    {
        $condition = new OrMatchingCardsCondition(
            new SuitMatchingCardsCondition(),
            new FaceMatchingCardsCondition()
        );

        $this->assertTrue(
            $condition->isTrue(
                new Card(Suit::Hearts, Face::Two),
                new Card(Suit::Hearts, Face::Three)
            )
        );
    }

    public function testIsFalse(): void
    {
        $condition = new OrMatchingCardsCondition(
            new SuitMatchingCardsCondition(),
            new FaceMatchingCardsCondition()
        );

        $this->assertFalse(
            $condition->isTrue(
                new Card(Suit::Hearts, Face::Two),
                new Card(Suit::Clubs, Face::Three)
            )
        );
    }
}