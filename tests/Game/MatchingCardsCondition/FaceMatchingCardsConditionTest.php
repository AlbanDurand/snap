<?php

namespace AlbanDurand\Snap\Tests\Game\MatchingCardsCondition;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\Face\Face;
use AlbanDurand\Snap\Card\Suit\Suit;
use AlbanDurand\Snap\Game\MatchingCardsCondition\ColorMatchingCardsCondition;
use PHPUnit\Framework\TestCase;

class FaceMatchingCardsConditionTest extends TestCase
{
    public function testIsTrue(): void
    {
        $condition = new ColorMatchingCardsCondition();

        $this->assertTrue(
            $condition->isTrue(
                new Card(Suit::Hearts, Face::Two),
                new Card(Suit::Diamonds, Face::Two)
            )
        );
    }

    public function testIsFalse(): void
    {
        $condition = new ColorMatchingCardsCondition();

        $this->assertFalse(
            $condition->isTrue(
                new Card(Suit::Hearts, Face::Two),
                new Card(Suit::Clubs, Face::Eight)
            )
        );
    }
}