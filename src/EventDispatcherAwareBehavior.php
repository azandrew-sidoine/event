<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event;

trait EventDispatcherAwareBehavior
{
    /**
     * @var EventDispatcher|null
     */
    protected $dispatcher;

    /**
     * {@inheritDoc}
     */
    public function useEventDispatcher(EventDispatcher $emitter): void
    {
        $this->dispatcher = $emitter;
    }

    /**
     * {@inheritDoc}
     */
    public function eventDispatcher(): EventDispatcher
    {
        if (null === $this->dispatcher) {
            $this->dispatcher = new EventDispatcher();
        }

        return $this->dispatcher;
    }
}
