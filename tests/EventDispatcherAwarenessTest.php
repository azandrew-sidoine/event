<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event\Tests;

use League\Event\EventDispatcher;
use League\Event\EventDispatcherAware;
use League\Event\EventDispatcherAwareBehavior;
use PHPUnit\Framework\TestCase;

class EventDispatcherAwarenessTest extends TestCase
{
    /**
     * @test
     * @covers \League\Event\EventDispatcherAware::useEventDispatcher
     * @covers \League\Event\EventDispatcherAware::eventDispatcher
     */
    public function using_a_event_dispatcher(): void
    {
        $instance = $this->eventDispatcherAwareInstance();
        $dispatcher = new EventDispatcher();
        $instance->useEventDispatcher($dispatcher);

        $this->assertSame($dispatcher, $instance->eventDispatcher());
    }

    /**
     * @test
     * @covers \League\Event\EventDispatcherAware::eventDispatcher
     */
    public function when_no_dispatcher_is_provided_a_dispatcher_is_created(): void
    {
        $instance = $this->eventDispatcherAwareInstance();

        $eventDispatcher = $instance->eventDispatcher();
        $this->assertInstanceOf(EventDispatcher::class, $eventDispatcher);
        $this->assertSame($eventDispatcher, $instance->eventDispatcher());
    }

    private function eventDispatcherAwareInstance(): EventDispatcherAware
    {
        return new class() implements EventDispatcherAware {
            use EventDispatcherAwareBehavior;
        };
    }
}
