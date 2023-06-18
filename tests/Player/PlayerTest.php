<?php

namespace AlbanDurand\Snap\Tests\Player;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\CardStack\CardStack;
use AlbanDurand\Snap\Card\Face\Face;
use AlbanDurand\Snap\Card\Suit\Suit;
use AlbanDurand\Snap\Player\Player;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testHasCards(): void
    {
        $player = new Player(
            0,
            new CardStack(
                new Card(Suit::Clubs, Face::A)
            )
        );

        $this->assertTrue($player->hasCards());
    }

    public function testHasNoCards(): void
    {
        $player = new Player(0, new CardStack());

        $this->assertFalse($player->hasCards());
    }

    public function testGetNumber(): void
    {
        $player = new Player(42, new CardStack());

        $this->assertEquals(42, $player->getNumber());
    }

    public function testGetHand(): void
    {
        $player = new Player(
            0,
            new CardStack(
                new Card(Suit::Clubs, Face::A),
                new Card(Suit::Hearts, Face::Eight)
            )
        );

        $this->assertEquals(
            new CardStack(
                new Card(Suit::Clubs, Face::A),
                new Card(Suit::Hearts, Face::Eight)
            ),
            $player->getHand()
        );
    }
}