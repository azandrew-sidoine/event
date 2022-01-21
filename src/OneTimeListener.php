<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event;

/**
 * @internal
 */
class OneTimeListener implements Listener
{
    /**
     * @var callable
     */
    protected $listener;

    public function __construct(callable $listener)
    {
        $this->listener = $listener;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(object $event): void
    {
        \call_user_func($this->listener, $event);
    }
}
