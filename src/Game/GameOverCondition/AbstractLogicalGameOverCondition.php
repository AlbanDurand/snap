<?php

namespace AlbanDurand\Snap\Game\GameOverCondition;

abstract class AbstractLogicalGameOverCondition implements GameOverConditionInterface
{
    /** @var GameOverConditionInterface[]  */
    protected readonly array $conditions;

    public function __construct(
        GameOverConditionInterface ...$conditions
    ) {
        $this->conditions = $conditions;
    }
}