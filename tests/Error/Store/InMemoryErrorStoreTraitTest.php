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

namespace OpenSolid\Domain\Tests\Error\Store;

use OpenSolid\Domain\Error\InvariantViolation;
use OpenSolid\Domain\Tests\Fixtures\Model\Entity;
use PHPUnit\Framework\TestCase;

class InMemoryErrorStoreTraitTest extends TestCase
{
    public function testPushingAndThrowingSingleError(): void
    {
        $this->expectException(InvariantViolation::class);
        $this->expectExceptionMessage('Business rule violation 1.');

        $entity = Entity::create();
        $entity->methodWithSingleInvariantViolation();
    }

    public function testPushingAndThrowingManyErrors(): void
    {
        $this->expectException(InvariantViolation::class);
        $this->expectExceptionMessage('Business rule violation 1. Business rule violation 2.');

        $entity = Entity::create();
        $entity->methodWithManyInvariantViolations();
    }
}
