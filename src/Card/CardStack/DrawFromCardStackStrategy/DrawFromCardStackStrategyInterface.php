<?php

namespace AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\CardStack\CardStackInterface;

interface DrawFromCardStackStrategyInterface
{
    public function execute(CardStackInterface $cardStack): Card;
}