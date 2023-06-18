<?php

namespace AlbanDurand\Snap\Event\EventSubscriber;

use AlbanDurand\Snap\Event\TurnPlayedEvent;
use AlbanDurand\Snap\Event\TurnWonEvent;
use DateTimeImmutable;
use DateTimeZone;

class LogEventSubscriber implements EventSubscriberInterface
{
    private array $logs = [];

    /**
     * Returns an associative array with event names as keys and method names as value
     *
     * @return array<string, string>
     */
    public function getSubscribedEvents(): array
    {
        return [
            TurnPlayedEvent::class => 'onTurnPlayed',
            TurnWonEvent::class => 'onTurnWon'
        ];
    }

    public function onTurnPlayed(TurnPlayedEvent $event): void
    {
        $this->log(
            sprintf(
                'Round #%s - Turn #%s - Player #%s',
                $event->roundNumber,
                $event->turnNumber,
                $event->playerNumber
            )
        );

        $this->log(
            sprintf(
                'Drawn card: %s of %s',
                $event->drawnCard->face->getLabel(),
                $event->drawnCard->suit->getSymbol(),
            )
        );

        $this->log(
            $event->cardOnTable === null
                ? 'No card on the table'
                : sprintf(
                    'Card on table: %s of %s',
                    $event->cardOnTable->face->getLabel(),
                    $event->cardOnTable->suit->getSymbol()
                )
        );
    }

    public function onTurnWon(TurnWonEvent $event): void
    {
        $this->log(
            sprintf(
                'Cards are a match, player #%s takes all the cards on the table.',
                $event->playerNumber
            )
        );
    }

    private function log(string $message): void
    {
        $this->logs[] = [
            'loggedAt' => new DateTimeImmutable('now', new DateTimeZone('UTC')),
            'message' => $message
        ];
    }

    /**
     * @return array[
     *  'loggedAt' => DateTimeInterface,
     *  'message' => string
     * ][]
     */
    public function getLogs(): array
    {
        return $this->logs;
    }
}