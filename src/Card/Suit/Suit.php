<?php

namespace AlbanDurand\Snap\Card\Suit;

use AlbanDurand\Snap\Card\Color\Color;

enum Suit
{
    case Clubs;
    case Spades;
    case Hearts;
    case Diamonds;

    public function getColor(): Color
    {
        return match($this) {
            Suit::Hearts, Suit::Diamonds => Color::Red,
            Suit::Clubs, Suit::Spades => Color::Black
        };
    }

    public function getSymbol(): string
    {
        return match($this) {
            Suit::Clubs => '♣',
            Suit::Spades => '♠',
            Suit::Hearts => '♥',
            Suit::Diamonds => '♦'
        };
    }
}