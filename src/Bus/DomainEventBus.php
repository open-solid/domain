<?php

declare(strict_types=1);

namespace OpenSolid\DomainEvent\Bus;

use OpenSolid\DomainEvent\DomainEvent;

/**
 * A message bus responsible for publishing domain events.
 */
interface DomainEventBus
{
    public function publish(DomainEvent ...$events): void;
}
