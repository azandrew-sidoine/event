<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event;

use Psr\EventDispatcher\EventDispatcherInterface;

interface EventDispatchingListenerRegistry extends ListenerRegistry, EventDispatcherInterface
{
}
