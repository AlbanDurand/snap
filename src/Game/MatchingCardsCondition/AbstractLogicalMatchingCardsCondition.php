<?php

namespace AlbanDurand\Snap\Game\MatchingCardsCondition;

abstract class AbstractLogicalMatchingCardsCondition implements MatchingCardsConditionInterface
{
    /** @var MatchingCardsConditionInterface[] */
    protected readonly array $conditions;

    public function __construct(
        MatchingCardsConditionInterface ...$conditions
    ) {
        $this->conditions = $conditions;
    }
}