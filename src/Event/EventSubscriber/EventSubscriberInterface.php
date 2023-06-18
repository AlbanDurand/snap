<?php

namespace AlbanDurand\Snap\Event\EventSubscriber;

interface EventSubscriberInterface
{
    /**
     * Returns an associative array with event names as keys and method names as value
     *
     * @return array<string, string>
     */
    public function getSubscribedEvents(): array;
}