<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event;

use Psr\EventDispatcher\ListenerProviderInterface;

class PrioritizedListenerRegistry implements ListenerRegistry, ListenerProviderInterface
{
    /** 
     * @var array<string,PrioritizedListenersForEvent>
     * 
     */
    protected $listenersPerEvent = [];

    /**
     * {@inheritDoc}
     */
    public function subscribeTo(string $event, callable $listener, int $priority = ListenerPriority::NORMAL): void
    {
        $group = \array_key_exists($event, $this->listenersPerEvent)
            ? $this->listenersPerEvent[$event]
            : $this->listenersPerEvent[$event] = new PrioritizedListenersForEvent();

        $group->addListener($listener, $priority);
    }

    /**
     * {@inheritDoc}
     */
    public function subscribeOnceTo(string $event, callable $listener, int $priority = ListenerPriority::NORMAL): void
    {
        $this->subscribeTo($event, new OneTimeListener($listener), $priority);
    }

    /**
     * {@inheritDoc} 
     */
    public function getListenersForEvent(object $event): iterable
    {
        /**
         * @var string                       $key
         * @var PrioritizedListenersForEvent $group
         */
        foreach ($this->listenersPerEvent as $key => $group) {
            if ($event instanceof $key) {
                yield from $group->getListeners();
            }
        }

        if ($event instanceof HasEventName) {
            yield from $this->getListenersForEventName($event->eventName());
        }

        if ($event instanceof StringableEvent) {
            yield from $this->getListenersForEventName((string)$event);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function subscribeListenersFrom(ListenerSubscriber $subscriber): void
    {
        $subscriber->subscribeListeners($this);
    }

    private function getListenersForEventName(string $eventName): iterable
    {
        if (!\array_key_exists($eventName, $this->listenersPerEvent)) {
            return [];
        }

        return $this->listenersPerEvent[$eventName]->getListeners();
    }
}
