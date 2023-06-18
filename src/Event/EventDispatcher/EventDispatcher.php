<?php

namespace AlbanDurand\Snap\Event\EventDispatcher;

use AlbanDurand\Snap\Event\EventSubscriber\EventSubscriberInterface;

class EventDispatcher implements EventDispatcherInterface
{
    /** @var EventSubscriberInterface[] */
    private array $subscribers;

    public function __construct(EventSubscriberInterface ...$subscribers)
    {
        $this->subscribers = $subscribers;
    }

    public function addSubscriber(EventSubscriberInterface $subscriber): void
    {
        $this->subscribers[] = $subscriber;
    }

    public function dispatch(object $event): void
    {
        foreach ($this->subscribers as $subscriber) {
            foreach ($subscriber->getSubscribedEvents() as $eventName => $handler) {
                if ($event::class === $eventName) {
                    call_user_func([$subscriber, $handler], $event);
                }
            }
        }
    }
}