<?php

namespace AlbanDurand\Snap\Tests\Card\Suit;

use AlbanDurand\Snap\Card\Color\Color;
use AlbanDurand\Snap\Card\Suit\Suit;
use PHPUnit\Framework\TestCase;

class SuitTest extends TestCase
{
    /**
     * @dataProvider getColorProvider
     */
    public function testGetColor(Suit $suit, Color $color): void
    {
        $this->assertEquals($color, $suit->getColor());
    }

    public function getColorProvider(): array
    {
        return [
            [Suit::Hearts, Color::Red],
            [Suit::Diamonds, Color::Red],
            [Suit::Clubs, Color::Black],
            [Suit::Spades, Color::Black]
        ];
    }
}