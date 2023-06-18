<?php

use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddToCardStackStrategyFactory;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawFromCardStackStrategyFactory;
use AlbanDurand\Snap\Card\CardStack\AddToCardStackStrategy\AddOnTopOfCardStackStrategy;
use AlbanDurand\Snap\Card\CardStack\CardStack;
use AlbanDurand\Snap\Card\CardStack\CardStackBuilder;
use AlbanDurand\Snap\Card\CardStack\CardStackInterface;
use AlbanDurand\Snap\Card\CardStack\DrawFromCardStackStrategy\DrawFromTopOfCardStackStrategy;
use AlbanDurand\Snap\Card\Face\Face;
use AlbanDurand\Snap\Card\Suit\Suit;
use AlbanDurand\Snap\Dealer\Dealer;
use AlbanDurand\Snap\Event\EventDispatcher\EventDispatcher;
use AlbanDurand\Snap\Event\EventSubscriber\LogEventSubscriber;
use AlbanDurand\Snap\Game\Game;
use AlbanDurand\Snap\Game\GameOverCondition\AtLeastOneEmptyHandGameOverCondition;
use AlbanDurand\Snap\Game\GameOverCondition\OrGameOverCondition;
use AlbanDurand\Snap\Game\GameRules\GameRules;
use AlbanDurand\Snap\Game\MatchingCardsCondition\MatchingCardsConditionFactory;
use AlbanDurand\Snap\Player\Player;
use AlbanDurand\Snap\Game\GameOverCondition\RoundLimitGameOverCondition;
use AlbanDurand\Snap\Game\GetWinnerStrategy\GetPlayerWithMostCardsWinnerStrategy;

try {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require realpath(__DIR__) . '/../vendor/autoload.php';

    $input = json_decode(file_get_contents('php://input'), false);

    $dealer = new Dealer(
        new DrawFromTopOfCardStackStrategy(),
        new AddOnTopOfCardStackStrategy()
    );

    $players = array_map(function (int $number): Player {
        return new Player($number, new CardStack());
    }, range(0, (int) $input->numberOfPlayers - 1));

    $decks = array_map(function (): CardStackInterface {
        return (new CardStackBuilder())
            ->withSuits(...Suit::cases())
            ->withFaces(...Face::cases())
            ->buildCardStack();
    }, range(0, (int) $input->numberOfDecks - 1));

    foreach ($decks as $deck) {
        $dealer->shuffle($deck);
    }

    $dealer->dealCardsOfDecksToPlayers($decks, $players);

    $logger = new LogEventSubscriber();

    $game = new Game(
        new EventDispatcher($logger),
        new GameRules(
            new OrGameOverCondition(
                new AtLeastOneEmptyHandGameOverCondition(),
                new RoundLimitGameOverCondition((int) $input->limitOfRounds)
            ),
            (new AddToCardStackStrategyFactory())->createFromString($input->addCardsToPlayerHandStrategy),
            (new DrawFromCardStackStrategyFactory())->createFromString($input->drawCardFromPlayerHandStrategy),
            (new MatchingCardsConditionFactory())->createFromString($input->matchingCardsCondition),
            new GetPlayerWithMostCardsWinnerStrategy()
        ),
        new CardStack(
            ...array_reduce(
                $decks,
                function (array $cards, CardStackInterface $deck): array {
                    return [...$cards, ...$deck->getCards()];
                },
                []
            )
        ),
        $players
    );

    while ($game->isOver() === false) {
        $game->playNextTurn();
    }

    $winner = $game->getWinner();

    $logs = $logger->getLogs();
    $logs[] = [
        'loggedAt' => new DateTimeImmutable('now', new DateTimeZone('UTC')),
        'message' => sprintf(
            'The winner is player #%s with %s card(s) in their hand!',
            $winner->getNumber(),
            count($winner->getHand()->getCards())
        )
    ];

    header('Content-Type: application/json');

    echo json_encode(array_map(
        function (array $log): string {
            return '[' . $log['loggedAt']->format('Y-m-d H:i:s, e') . '] ' . $log['message'];
        },
        $logs
    ));
} catch (Exception $e) {
    http_response_code(422);

    echo '<b>' . $e->getMessage() . '</b>';
}
