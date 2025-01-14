<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event\Tests\Stubs;

use League\Event\HasEventName;

/** @package League\Event\Tests\Stubs */
class StubNamedEvent implements HasEventName
{
    /**
     * @var string
     */
    private $eventName;

    public function __construct(string $eventName)
    {
        $this->eventName = $eventName;
    }

    public function eventName(): string
    {
        return $this->eventName;
    }
}
