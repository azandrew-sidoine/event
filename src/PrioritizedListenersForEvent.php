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
class PrioritizedListenersForEvent
{
    /**
     *  @var array<int, array<int,callable>> 
     */
    private $listeners = [];

    /** 
     * @var array<int,callable> 
     */
    private $sortedListeners = [];

    /** 
     * @var bool 
     */
    private $isSorted = false;


    /**
     *  @var bool 
     */
    private $containsOneTimeListener = false;

    public function addListener(callable $listener, int $priority): void
    {
        $this->isSorted = false;
        $this->listeners[$priority][] = $listener;

        if ($listener instanceof OneTimeListener) {
            $this->containsOneTimeListener = true;
        }
    }

    public function getListeners(): iterable
    {
        if (false === $this->isSorted) {
            $this->sortListeners();
        }

        $listeners = $this->sortedListeners;

        if ($this->containsOneTimeListener) {
            $this->removeOneTimeListeners();
        }

        return $listeners;
    }

    private function sortListeners(): void
    {
        $this->isSorted = true;
        krsort($this->listeners, \SORT_NUMERIC);

        $this->sortedListeners = iterator_to_array(
            (function () {
                foreach ($this->listeners as $group) {
                    foreach ($group as $listener) {
                        yield $listener;
                    }
                }
            })()
        );
    }

    private function removeOneTimeListeners(): void
    {
        $filter = static function ($listener): bool {
            return false === $listener instanceof OneTimeListener;
        };

        $this->sortedListeners = array_filter($this->sortedListeners, $filter);

        foreach ($this->listeners as $priority => $listeners) {
            $this->listeners[$priority] = array_filter($this->sortedListeners, $filter);
        }
    }
}
