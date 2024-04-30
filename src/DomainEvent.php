<?php

declare(strict_types=1);

namespace OpenSolid\DomainEvent;

use DateTimeImmutable;
use OpenSolid\Messenger\Model\Message;

/**
 * @psalm-immutable
 */
abstract readonly class DomainEvent implements Message
{
    public string $eventId;
    public DateTimeImmutable $occurredOn;

    public function __construct(public string $aggregateId)
    {
        $this->eventId = uuid_create(UUID_TYPE_RANDOM);
        $this->occurredOn = new DateTimeImmutable();
    }
}
