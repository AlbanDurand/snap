<?php

namespace AlbanDurand\Snap\Tests\Card\CardStack\AddToCardStackStrategy;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddOnTopOfCardStackStrategy;
use AlbanDurand\Snap\Card\CardStack\CardStack;
use AlbanDurand\Snap\Card\Face\Face;
use AlbanDurand\Snap\Card\Suit\Suit;
use PHPUnit\Framework\TestCase;

class AddOnTopOfCardStackStrategyTest extends TestCase
{
    public function testExecute(): void
    {
        $strategy = new AddOnTopOfCardStackStrategy();

        $stack = new CardStack(
            new Card(Suit::Clubs, Face::Five),
            new Card(Suit::Spades, Face::A),
            new Card(Suit::Spades, Face::Ten)
        );

        $strategy->execute($stack, [new Card(Suit::Diamonds, Face::Five)]);

        $this->assertCount(4, $stack->getCards());
        $this->assertEquals(
            new Card(Suit::Diamonds, Face::Five),
            $stack->getCards()[3]
        );
    }
}