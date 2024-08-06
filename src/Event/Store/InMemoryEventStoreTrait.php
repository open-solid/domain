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

namespace OpenSolid\Domain\Event\Store;

use OpenSolid\Domain\Event\DomainEvent;

trait InMemoryEventStoreTrait
{
    /**
     * @var array<class-string<DomainEvent>, DomainEvent>
     */
    private array $domainEvents = [];

    final protected function pushDomainEvent(DomainEvent $domainEvent): void
    {
        $this->domainEvents[$domainEvent::class] ??= $domainEvent;
    }

    /**
     * @return array<DomainEvent>
     */
    final public function pullDomainEvents(): array
    {
        $domainEvents = $this->domainEvents;
        $this->domainEvents = [];

        return array_values($domainEvents);
    }
}
