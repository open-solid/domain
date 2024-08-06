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

use OpenSolid\Domain\Event\DomainEvent;

/**
 * A message bus responsible for publishing domain events.
 */
interface EventBus
{
    public function publish(DomainEvent ...$events): void;
}
