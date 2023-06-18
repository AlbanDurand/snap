<?php

namespace AlbanDurand\Snap\Event\EventDispatcher;

use AlbanDurand\Snap\Event\EventSubscriber\EventSubscriberInterface;

interface EventDispatcherInterface
{
    public function addSubscriber(EventSubscriberInterface $subscriber): void;

    public function dispatch(object $event): void;
}