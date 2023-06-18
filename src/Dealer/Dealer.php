<?php

namespace AlbanDurand\Snap\Dealer;

use AlbanDurand\Snap\Card\Card;
use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddToCardStackStrategyInterface;
use AlbanDurand\Snap\Card\CardStack\CardStackInterface;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawFromCardStackStrategyInterface;
use AlbanDurand\Snap\Player\Player;

class Dealer implements DealerInterface
{
    public function __construct(
        private readonly DrawFromCardStackStrategyInterface $drawCardFromDeckStrategy,
        private readonly AddToCardStackStrategyInterface $addCardToPlayerHandStrategy
    ) {}

    /**
     * The dealer deals an equal amount of cards between each player.
     * Therefore, there may be cards remaining in the decks.
     *
     * @param CardStackInterface[] $decks
     * @param Player[] $players
     */
    public function dealCardsOfDecksToPlayers(
        array $decks,
        array $players
    ): void {
        foreach ($decks as $deck) {
            $this->dealCardsOfDeckToPlayers($deck, $players);
        }
    }

    /**
     * @param Player[] $players
     */
    private function dealCardsOfDeckToPlayers(
        CardStackInterface $deck,
        array $players
    ): void {
        $totalOfCardsToDeal = $this->getTotalOfCardsToDeal($deck, $players);

        for ($turnNumber = 0; $turnNumber < $totalOfCardsToDeal; $turnNumber++) {
            $this->dealCardToPlayer(
                $this->drawCardFromDeck($deck),
                $this->getPlayerToWhomDealCard($players, $turnNumber)
            );
        }
    }

    public function shuffle(CardStackInterface $cardStack): void
    {
        $cards = $cardStack->getCards();

        shuffle($cards);

        $cardStack->setCards(...$cards);
    }

    private function getTotalOfCardsToDeal(
        CardStackInterface $deck,
        array $players
    ): int {
        return (int) (count($deck->getCards()) / count($players)) * count($players);
    }

    /**
     * @param Player[] $players
     */
    private function getPlayerToWhomDealCard(
        array $players,
        int $turnNumber
    ): Player {
        return $players[$turnNumber % count($players)];
    }

    private function drawCardFromDeck(CardStackInterface $deck): Card
    {
        return $this->drawCardFromDeckStrategy->execute($deck);
    }

    private function dealCardToPlayer(Card $card, Player $player): void
    {
        $this->addCardToPlayerHandStrategy->execute($player->getHand(), [$card]);
    }
}
