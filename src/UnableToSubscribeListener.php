<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Event;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

class UnableToSubscribeListener extends \LogicException
{
    public static function becauseTheListenerProviderDoesNotAcceptListeners(
        ListenerProviderInterface $configuredListenerProvider
    ): self {
        $providerClass = \get_class($configuredListenerProvider);

        return new self(
            "Unable to add listener because the configured listener provider {$providerClass} is not an instance of "
            .ListenerRegistry::class
        );
    }

    public static function becauseTheEventDispatcherDoesNotAcceptListeners(
        EventDispatcherInterface $configuredListenerProvider
    ): self {
        $providerClass = \get_class($configuredListenerProvider);

        return new self(
            "Unable to add listener because the internal dispatcher {$providerClass} is not an instance of "
            .ListenerRegistry::class
        );
    }
}
