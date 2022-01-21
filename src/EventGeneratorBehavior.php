<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event;

trait EventGeneratorBehavior
{
    /**
     * @var object[]
     */
    protected $events = [];

    /**
     * {@inheritDoc}
     */
    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    /**
     * Register a new event in the generator
     * 
     * @param object $event 
     * 
     * @return self 
     */
    protected function recordEvent(object $event): self
    {
        $this->events[] = $event;

        return $this;
    }
}
