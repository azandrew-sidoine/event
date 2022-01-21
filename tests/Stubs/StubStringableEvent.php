<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event\Tests\Stubs;

use League\Event\StringableEvent;

/** @package League\Event\Tests\Stubs */
class StubStringableEvent implements StringableEvent
{
    /**
     * @var string
     */
    private $eventName;

    public function __construct(string $eventName)
    {
        $this->eventName = $eventName;
    }

    public function __toString(): string
    {
        return $this->eventName;
    }
}
