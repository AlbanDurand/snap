<?php

namespace AlbanDurand\Snap\Game\MatchingCardsCondition;

class MatchingCardsConditionFactory
{
    public function createFromString(
        string $condition
    ): MatchingCardsConditionInterface {
        switch ($condition) {
            case 'suit':
                return new SuitMatchingCardsCondition();

            case 'face':
                return new FaceMatchingCardsCondition();

            case 'color':
                return new ColorMatchingCardsCondition();

            case 'suit_and_face':
                return new AndMatchingCardsCondition(
                    new SuitMatchingCardsCondition(),
                    new FaceMatchingCardsCondition()
                );

            case 'suit_or_face':
                return new OrMatchingCardsCondition(
                    new SuitMatchingCardsCondition(),
                    new FaceMatchingCardsCondition()
                );

            case 'face_and_color':
                return new AndMatchingCardsCondition(
                    new FaceMatchingCardsCondition(),
                    new ColorMatchingCardsCondition()
                );

            case 'face_or_color':
                return new OrMatchingCardsCondition(
                    new FaceMatchingCardsCondition(),
                    new ColorMatchingCardsCondition()
                );

            case 'suit_or_color':
                return new OrMatchingCardsCondition(
                    new SuitMatchingCardsCondition(),
                    new ColorMatchingCardsCondition()
                );

            default:
                throw new MatchingCardsConditionFactoryException(
                    sprintf(
                        '%s does not handle the string "%s".',
                        self::class,
                        $condition
                    )
                );
        }
    }
}