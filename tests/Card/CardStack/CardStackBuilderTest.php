<?php

namespace AlbanDurand\Snap\Tests\Card\CardStack;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\CardStack\CardStack;
use AlbanDurand\Snap\Card\CardStack\CardStackBuilder;
use AlbanDurand\Snap\Card\Face\Face;
use AlbanDurand\Snap\Card\Suit\Suit;
use PHPUnit\Framework\TestCase;

class CardStackBuilderTest extends TestCase
{
    public function testBuildCardStack(): void
    {
        $builder = new CardStackBuilder();

        $builder
            ->withSuits(Suit::Clubs, Suit::Diamonds)
            ->withFaces(Face::K, Face::Q);

        $stack = $builder->buildCardStack();

        $this->assertEquals(
            new CardStack(
                new Card(Suit::Clubs, Face::K),
                new Card(Suit::Clubs, Face::Q),
                new Card(Suit::Diamonds, Face::K),
                new Card(Suit::Diamonds, Face::Q)
            ),
            $stack
        );
    }
}