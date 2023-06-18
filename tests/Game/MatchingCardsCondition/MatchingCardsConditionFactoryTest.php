<?php

namespace AlbanDurand\Snap\Tests\Game\MatchingCardsCondition;

use AlbanDurand\Snap\Game\MatchingCardsCondition\AndMatchingCardsCondition;
use AlbanDurand\Snap\Game\MatchingCardsCondition\ColorMatchingCardsCondition;
use AlbanDurand\Snap\Game\MatchingCardsCondition\FaceMatchingCardsCondition;
use AlbanDurand\Snap\Game\MatchingCardsCondition\MatchingCardsConditionFactory;
use AlbanDurand\Snap\Game\MatchingCardsCondition\MatchingCardsConditionInterface;
use AlbanDurand\Snap\Game\MatchingCardsCondition\OrMatchingCardsCondition;
use AlbanDurand\Snap\Game\MatchingCardsCondition\SuitMatchingCardsCondition;
use PHPUnit\Framework\TestCase;

class MatchingCardsConditionFactoryTest extends TestCase
{
    /**
     * @dataProvider createFromStringProvider
     */
    public function testCreateFromString(
        string $conditionName,
        MatchingCardsConditionInterface $condition
    ): void {
        $factory = new MatchingCardsConditionFactory();

        $this->assertEquals($condition, $factory->createFromString($conditionName));
    }

    public function createFromStringProvider(): array
    {
        return [
            [
                'suit',
                new SuitMatchingCardsCondition()
            ],
            [
                'face',
                new FaceMatchingCardsCondition()
            ],
            [
                'color',
                new ColorMatchingCardsCondition()
            ],
            [
                'suit_and_face',
                new AndMatchingCardsCondition(
                    new SuitMatchingCardsCondition(),
                    new FaceMatchingCardsCondition()
                )
            ],
            [
                'suit_or_face',
                new OrMatchingCardsCondition(
                    new SuitMatchingCardsCondition(),
                    new FaceMatchingCardsCondition()
                )
            ],
            [
                'face_and_color',
                new AndMatchingCardsCondition(
                    new FaceMatchingCardsCondition(),
                    new ColorMatchingCardsCondition()
                )
            ],
            [
                'face_or_color',
                new OrMatchingCardsCondition(
                    new FaceMatchingCardsCondition(),
                    new ColorMatchingCardsCondition()
                )
            ],
            [
                'suit_or_color',
                new OrMatchingCardsCondition(
                    new SuitMatchingCardsCondition(),
                    new ColorMatchingCardsCondition()
                )
            ]
        ];
    }
}