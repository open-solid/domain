<?php

declare(strict_types=1);

namespace OpenSolid\DomainEvent\Bus;

use OpenSolid\DomainEvent\DomainEvent;

interface DomainEventBus
{
    public function publish(DomainEvent ...$events): void;
}
