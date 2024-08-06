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

namespace OpenSolid\Domain\Event;

use OpenSolid\Bus\Envelope\Message;
use OpenSolid\Domain\Model\Uid\UuidV7Rfc4122;

/**
 * @extends Message<void>
 */
abstract readonly class DomainEvent extends Message
{
    public string $eventId;
    public \DateTimeImmutable $occurredOn;

    public function __construct(public string $aggregateId)
    {
        $this->eventId = UuidV7Rfc4122::generate();
        $this->occurredOn = new \DateTimeImmutable();
    }
}
