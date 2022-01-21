<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event;

interface Listener
{
    /**
     * 
     * @param object $event 
     * @return void 
     */
    public function __invoke(object $event): void;
}
