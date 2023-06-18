<?php

namespace AlbanDurand\Snap\Tests\Card\CardStack\AddToCardStackStrategy;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\CardStack\CardStack;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawRandomlyFromCardStackStrategy;
use AlbanDurand\Snap\Card\Face\Face;
use AlbanDurand\Snap\Card\Suit\Suit;
use PHPUnit\Framework\TestCase;

class DrawRandomlyFromCardStackStrategyTest extends TestCase
{
    public function testExecute(): void
    {
        $strategy = new DrawRandomlyFromCardStackStrategy();

        $stack = new CardStack(
            new Card(Suit::Clubs, Face::Five),
            new Card(Suit::Spades, Face::A),
            new Card(Suit::Spades, Face::Ten),
            new Card(Suit::Diamonds, Face::Ten),
            new Card(Suit::Clubs, Face::Two),
            new Card(Suit::Hearts, Face::K)
        );

        // We set a seed to get a predictable result.
        // The first number to be generated between 0 and 5 should be 4
        mt_srand(123);

        $drawnCard = $strategy->execute($stack);

        $this->assertCount(5, $stack->getCards());
        $this->assertEquals(new Card(Suit::Clubs, Face::Two), $drawnCard);
    }
}