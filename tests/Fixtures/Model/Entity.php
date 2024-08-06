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

namespace OpenSolid\Domain\Tests\Fixtures\Model;

use OpenSolid\Domain\Error\InvariantViolation;
use OpenSolid\Domain\Error\Store\InMemoryErrorStoreTrait;
use OpenSolid\Domain\Event\Store\InMemoryEventStoreTrait;
use OpenSolid\Domain\Tests\Fixtures\Event\EntityCreated;
use OpenSolid\Domain\Tests\Fixtures\Event\EntityUpdated;

final class Entity
{
    use InMemoryEventStoreTrait;
    use InMemoryErrorStoreTrait;

    public static function create(/* ... */): self
    {
        $entity = new self();
        // init properties
        $entity->pushDomainEvent(new EntityCreated('id'));

        return $entity;
    }

    public function update(/* ... */): void
    {
        // update properties ...

        $this->pushDomainEvent(new EntityUpdated('id'));
    }

    public function methodWithSingleInvariantViolation(/* ... */): void
    {
        // business logic validation ...

        $this->pushDomainError(InvariantViolation::create('Business rule violation 1.'));

        $this->throwDomainErrors();
    }

    public function methodWithManyInvariantViolations(/* ... */): void
    {
        // business logic validation ...

        $this->pushDomainError(InvariantViolation::create('Business rule violation 1.'));

        // business logic validation ...

        $this->pushDomainError(InvariantViolation::create('Business rule violation 2.'));

        $this->throwDomainErrors();
    }
}
