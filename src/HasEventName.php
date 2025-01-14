<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event;

interface HasEventName
{
    /**
     * Returns the string representation of the Event
     * 
     * @return string 
     */
    public function eventName(): string;
}
