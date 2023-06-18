<?php

namespace AlbanDurand\Snap\Tests\Card\CardStack;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\CardStack\CardStack;
use AlbanDurand\Snap\Card\Face\Face;
use AlbanDurand\Snap\Card\Suit\Suit;
use PHPUnit\Framework\TestCase;

class CardStackTest extends TestCase
{
    public function testSetCards(): void
    {
        $stack = new CardStack();

        $stack->setCards(new Card(Suit::Clubs, Face::Five), new Card(Suit::Diamonds, Face::A));

        $this->assertCount(2, $stack->getCards());

        $this->assertEquals(
            [
                new Card(Suit::Clubs, Face::Five),
                new Card(Suit::Diamonds, Face::A)
            ],
            $stack->getCards()
        );
    }
}