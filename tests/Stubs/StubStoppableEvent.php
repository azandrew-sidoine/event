<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event\Tests\Stubs;

use Psr\EventDispatcher\StoppableEventInterface;

class StubStoppableEvent implements StoppableEventInterface
{
    /**
     * @var bool
     */
    private $isStopped = false;

    public function stopPropagation(): void
    {
        $this->isStopped = true;
    }

    public function isPropagationStopped(): bool
    {
        return $this->isStopped;
    }
}
