<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event;

use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\EventDispatcher\StoppableEventInterface;

class EventDispatcher implements EventDispatchingListenerRegistry
{
    /**
     * @var ListenerProviderInterface
     */
    protected $listenerProvider;

    public function __construct(?ListenerProviderInterface $listenerProvider = null)
    {
        $this->listenerProvider = $listenerProvider instanceof ListenerProviderInterface
            ? $listenerProvider
            : new PrioritizedListenerRegistry();
    }

    public function dispatch(object $event): object
    {
        $listeners = $this->listenerProvider->getListenersForEvent($event);

        $this->dispatchEvent($listeners, $event);

        return $event;
    }

    public function dispatchGeneratedEvents(EventGenerator $generator): void
    {
        foreach ($generator->releaseEvents() as $event) {
            $this->dispatch($event);
        }
    }

    public function subscribeTo(string $event, callable $listener, int $priority = ListenerPriority::NORMAL): void
    {
        if (!$this->listenerProvider instanceof ListenerRegistry) {
            throw UnableToSubscribeListener::becauseTheListenerProviderDoesNotAcceptListeners($this->listenerProvider);
        }

        $this->listenerProvider->subscribeTo($event, $listener, $priority);
    }

    public function subscribeOnceTo(string $event, callable $listener, int $priority = ListenerPriority::NORMAL): void
    {
        if (!$this->listenerProvider instanceof ListenerRegistry) {
            throw UnableToSubscribeListener::becauseTheListenerProviderDoesNotAcceptListeners($this->listenerProvider);
        }

        $this->listenerProvider->subscribeOnceTo($event, $listener, $priority);
    }

    public function subscribeListenersFrom(ListenerSubscriber $subscriber): void
    {
        if (!$this->listenerProvider instanceof ListenerRegistry) {
            throw UnableToSubscribeListener::becauseTheListenerProviderDoesNotAcceptListeners($this->listenerProvider);
        }

        $this->listenerProvider->subscribeListenersFrom($subscriber);
    }

    private function dispatchEvent(iterable $listeners, object $event): void
    {
        foreach ($listeners as $listener) {
            if ($event instanceof StoppableEventInterface && $event->isPropagationStopped()) {
                break;
            }
            $listener($event);
        }
    }
}
