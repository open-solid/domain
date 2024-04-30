<?php

namespace OpenSolid\DomainEvent\Bus;

use OpenSolid\DomainEvent\DomainEvent;
use OpenSolid\Messenger\Bus\FlushableMessageBus;
use OpenSolid\Messenger\Bus\LazyMessageBus;

final readonly class NativeDomainEventBus implements DomainEventBus, FlushableMessageBus
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
