<?php

namespace AlbanDurand\Snap\Tests\Dealer;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddOnTopOfCardStackStrategy;
use AlbanDurand\Snap\Card\CardStack\CardStack;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawFromTopOfCardStackStrategy;
use AlbanDurand\Snap\Card\Face\Face;
use AlbanDurand\Snap\Card\Suit\Suit;
use AlbanDurand\Snap\Dealer\Dealer;
use AlbanDurand\Snap\Player\Player;
use PHPUnit\Framework\TestCase;

class DealerTest extends TestCase
{
    public function testDealCardsOfDecksToPlayers(): void
    {
        $dealer = new Dealer(
            new DrawFromTopOfCardStackStrategy(),
            new AddOnTopOfCardStackStrategy()
        );

        $decks = [
            new CardStack(
                new Card(Suit::Clubs, Face::A),
                new Card(Suit::Clubs, Face::Two),
                new Card(Suit::Clubs, Face::Three),
                new Card(Suit::Clubs, Face::Four),
                new Card(Suit::Clubs, Face::Five)
            )
        ];

        $players = [
            new Player(0, new CardStack()),
            new Player(1, new CardStack())
        ];

        $dealer->dealCardsOfDecksToPlayers($decks, $players);

        $this->assertCount(1, $decks[0]->getCards());

        $this->assertEquals(
            new CardStack(
                new Card(Suit::Clubs, Face::Five),
                new Card(Suit::Clubs, Face::Three)
            ),
            $players[0]->getHand()
        );

        $this->assertEquals(
            new CardStack(
                new Card(Suit::Clubs, Face::Four),
                new Card(Suit::Clubs, Face::Two)
            ),
            $players[1]->getHand()
        );
    }
}