<?php

namespace League\Event;

/** @package League\Event */
interface StringableEvent
{
    /**
     * Returns the string representation of the event
     * 
     * @return string 
     */
    public function __toString(): string;
}
