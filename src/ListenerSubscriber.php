<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event;

interface ListenerSubscriber
{
    /**
     * Subscribe a listener to a registry
     * 
     * @param ListenerRegistry $acceptor 
     * @return void 
     */
    public function subscribeListeners(ListenerRegistry $acceptor): void;
}
