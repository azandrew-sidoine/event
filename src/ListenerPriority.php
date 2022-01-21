<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event;

final class ListenerPriority
{
    /**
     * High priority.
     *
     * @const int
     */
    public const HIGH = 100;

    /**
     * Normal priority.
     *
     * @const int
     */
    public const NORMAL = 0;

    /**
     * Low priority.
     *
     * @const int
     */
    public const LOW = -100;
}
