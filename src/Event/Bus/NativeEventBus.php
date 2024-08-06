<?php

declare(strict_types=1);

/*
 * This file is part of OpenSolid package.
 *
 * (c) Yonel Ceruto <open@yceruto.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenSolid\Domain\Event\Bus;

use OpenSolid\Bus\FlushableMessageBus;
use OpenSolid\Bus\LazyMessageBus;
use OpenSolid\Domain\Event\DomainEvent;

final readonly class NativeEventBus implements EventBus, FlushableMessageBus
{
    public function __construct(
        private LazyMessageBus $messageBus,
    ) {
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            $this->messageBus->dispatch($event);
        }
    }

    public function flush(): void
    {
        $this->messageBus->flush();
    }
}
