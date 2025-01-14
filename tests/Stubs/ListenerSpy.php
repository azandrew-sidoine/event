<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event\Tests\Stubs;

use League\Event\Listener;

class ListenerSpy implements Listener
{
    /**
     * @var object|null
     */
    private $calledWith = null;

    /**
     * @var int
     */
    private $timesCalled = 0;

    public function __invoke(object $event): void
    {
        ++$this->timesCalled;
        $this->calledWith = $event;
    }

    public function numberOfTimeCalled(): int
    {
        return $this->timesCalled;
    }

    public function wasCalledWith(object $event): bool
    {
        return $event === $this->calledWith;
    }
}
