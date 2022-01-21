<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event;

use Psr\EventDispatcher\EventDispatcherInterface;

class BufferedEventDispatcher implements EventDispatchingListenerRegistry
{
    use EventGeneratorBehavior {
        recordEvent as protected;
        releaseEvents as protected;
    }

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function dispatch(object $event): object
    {
        $this->recordEvent($event);

        return $event;
    }

    /**
     * @return object[]
     */
    public function dispatchBufferedEvents(): array
    {
        return iterator_to_array(
            (function () {
                foreach ($this->releaseEvents() as $event) {
                    yield $this->dispatcher->dispatch($event);
                }
            })()
        );
    }

    public function subscribeTo(string $event, callable $listener, int $priority = ListenerPriority::NORMAL): void
    {
        if (!$this->dispatcher instanceof ListenerRegistry) {
            throw UnableToSubscribeListener::becauseTheEventDispatcherDoesNotAcceptListeners($this->dispatcher);
        }

        $this->dispatcher->subscribeTo($event, $listener, $priority);
    }

    public function subscribeOnceTo(string $event, callable $listener, int $priority = ListenerPriority::NORMAL): void
    {
        if (!$this->dispatcher instanceof ListenerRegistry) {
            throw UnableToSubscribeListener::becauseTheEventDispatcherDoesNotAcceptListeners($this->dispatcher);
        }

        $this->dispatcher->subscribeOnceTo($event, $listener, $priority);
    }

    public function subscribeListenersFrom(ListenerSubscriber $subscriber): void
    {
        if (!$this->dispatcher instanceof ListenerRegistry) {
            throw UnableToSubscribeListener::becauseTheEventDispatcherDoesNotAcceptListeners($this->dispatcher);
        }

        $this->dispatcher->subscribeListenersFrom($subscriber);
    }
}
