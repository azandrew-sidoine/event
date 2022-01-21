<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event;

interface ListenerRegistry
{
    /**
     * Subscribe a listener to an event
     * 
     * @param string $event 
     * @param callable $listener 
     * @param int $priority 
     * @return void 
     */
    public function subscribeTo(string $event, callable $listener, int $priority = ListenerPriority::NORMAL): void;

    /**
     * Subscribe a listener to an event that only runs once
     *
     * @param string $event
     * @param callable $listener
     * @param [type] $priority
     * @return void
     */
    public function subscribeOnceTo(string $event, callable $listener, int $priority = ListenerPriority::NORMAL): void;

    /**
     * Subscribe a listener using a listener subscriber
     * 
     * @param ListenerSubscriber $subscriber 
     * @return void 
     */
    public function subscribeListenersFrom(ListenerSubscriber $subscriber): void;
}
