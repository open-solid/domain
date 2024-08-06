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

namespace OpenSolid\Domain\Tests\Event\Store;

use OpenSolid\Domain\Tests\Fixtures\Event\EntityCreated;
use OpenSolid\Domain\Tests\Fixtures\Event\EntityUpdated;
use OpenSolid\Domain\Tests\Fixtures\Model\Entity;
use PHPUnit\Framework\TestCase;

class InMemoryEventStoreTraitTest extends TestCase
{
    public function testPushingAndPullingDomainEvents(): void
    {
        $entity = Entity::create();

        $events = $entity->pullDomainEvents();

        $this->assertCount(1, $events);
        $this->assertInstanceOf(EntityCreated::class, $events[0]);
    }

    public function testUniqueDomainEvents(): void
    {
        $entity = Entity::create();
        $entity->update();
        $entity->update();

        $events = $entity->pullDomainEvents();

        $this->assertCount(2, $events);
        $this->assertInstanceOf(EntityCreated::class, $events[0]);
        $this->assertInstanceOf(EntityUpdated::class, $events[1]);
    }
}
