<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event;

interface EventDispatcherAware
{
    /**
     * Define the EventDispatcher to be used
     * 
     * @param EventDispatcher $dispatcher 
     * @return void 
     */
    public function useEventDispatcher(EventDispatcher $dispatcher): void;

    /**
     * Returns the event dispatcher registered
     * 
     * @return EventDispatcher 
     */
    public function eventDispatcher(): EventDispatcher;
}
